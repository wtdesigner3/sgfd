<?php
/**
 * 5th Global Food & Bakery Expo - Visitor Pass Generator
 * Shared generation function for submit.php and pass-preview.php
 */

function generateVisitorPassImage($name, $designation, $company, $qrFileFs, $passFileFs) {
    $bgFile = __DIR__ . '/pass_5th_bg.png';
    if (!file_exists($bgFile)) {
        $bgFile = __DIR__ . '/pass-bg.png';
    }

    $image = false;
    if (file_exists($bgFile)) {
        $image = @imagecreatefrompng($bgFile);
        if ($image === false && file_exists(__DIR__ . '/pass_5th_bg.jpg')) {
            $image = @imagecreatefromjpeg(__DIR__ . '/pass_5th_bg.jpg');
        }
    }

    if ($image === false) {
        $width = 2000;
        $height = 1353;
        $image = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $white);
    }

    $textColor = imagecolorallocate($image, 20, 20, 20);
    $subColor  = imagecolorallocate($image, 60, 60, 60);

    $fontBold = __DIR__ . '/fonts/Poppins-Bold.ttf';
    $fontReg  = __DIR__ . '/fonts/Poppins-Regular.ttf';
    if (!file_exists($fontBold)) {
        $fontBold = $fontReg;
    }

    $cx   = 481; // Center of left badge (0 to 958 px)
    $maxW = 750; // Maximum allowed text width before shrinking

    // Helper to shrink text to fit width and center it
    $fitAndDraw = function($img, $text, $size, $font, $yBaseline, $color, $cx, $maxWidth, $minSize = 13) {
        $text = trim($text);
        if ($text === '') return [0, 0];
        while ($size >= $minSize) {
            $bbox = imagettfbbox($size, 0, $font, $text);
            $w = abs($bbox[2] - $bbox[0]);
            if ($w <= $maxWidth) break;
            $size -= 1;
        }
        $bbox = imagettfbbox($size, 0, $font, $text);
        $w = abs($bbox[2] - $bbox[0]);
        $x = (int)($cx - ($w / 2));
        imagettftext($img, $size, 0, $x, $yBaseline, $color, $font, $text);
        return [$size, $w];
    };

    $hasName  = (trim($name) !== '');
    $hasDesig = (trim($designation) !== '');
    $hasComp  = (trim($company) !== '');

    if (file_exists($fontReg) && function_exists('imagettftext')) {
        if ($hasDesig && $hasComp) {
            $fitAndDraw($image, $name, 34, $fontBold, 942, $textColor, $cx, $maxW);
            $fitAndDraw($image, $designation, 22, $fontReg, 982, $subColor, $cx, $maxW);
            $fitAndDraw($image, $company, 20, $fontReg, 1018, $subColor, $cx, $maxW);
            $qrY = 1038;
        } elseif ($hasDesig || $hasComp) {
            $fitAndDraw($image, $name, 36, $fontBold, 950, $textColor, $cx, $maxW);
            $singleSub = $hasDesig ? $designation : $company;
            $fitAndDraw($image, $singleSub, 22, $fontReg, 995, $subColor, $cx, $maxW);
            $qrY = 1038;
        } else {
            $fitAndDraw($image, $name, 38, $fontBold, 970, $textColor, $cx, $maxW);
            $qrY = 1032;
        }
    } else {
        // Fallback for built-in GD fonts
        $centerLine = function($text, $fontNum) use ($cx) {
            $w = imagefontwidth($fontNum) * strlen($text);
            return (int)($cx - ($w / 2));
        };
        if ($hasName)  imagestring($image, 5, $centerLine($name, 5), 935, $name, $textColor);
        if ($hasDesig) imagestring($image, 4, $centerLine($designation, 4), 975, $designation, $subColor);
        if ($hasComp)  imagestring($image, 4, $centerLine($company, 4), 1010, $company, $subColor);
        $qrY = 1038;
    }

    // Embed QR Code
    if (!empty($qrFileFs) && file_exists($qrFileFs)) {
        $qrImg = @imagecreatefrompng($qrFileFs);
        if ($qrImg !== false) {
            $qrSize = 160;
            $qrX = (int)($cx - ($qrSize / 2));
            imagecopyresampled(
                $image,
                $qrImg,
                $qrX, $qrY,
                0, 0,
                $qrSize, $qrSize,
                imagesx($qrImg),
                imagesy($qrImg)
            );
            imagedestroy($qrImg);
        }
    }

    imagepng($image, $passFileFs, 6);
    imagedestroy($image);
    return true;
}
