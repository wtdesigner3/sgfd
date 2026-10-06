import os
import sys
import time
from ftplib import FTP, error_perm, error_temp

def main():
    server = os.environ.get('FTP_SERVER', '').strip()
    user = os.environ.get('FTP_USERNAME', '').strip()
    password = os.environ.get('FTP_PASSWORD', '').strip()
    server_dir = os.environ.get('FTP_SERVER_DIR', '').strip() or '.'

    if not server or not user or not password:
        print("ERROR: FTP_SERVER, FTP_USERNAME, or FTP_PASSWORD is not set!")
        sys.exit(1)

    print(f"Connecting to FTP server: {server}...")
    ftp = FTP(timeout=300)
    try:
        ftp.connect(server, 21)
        print("Connected! Welcome message:")
        print(ftp.getwelcome().strip())
        
        ftp.login(user, password)
        print(f"Authenticated successfully as: {user}")
        
        ftp.set_pasv(True)
        print("Passive mode enabled.")
        
        current_dir = ftp.pwd()
        print(f"Initial remote directory: {current_dir}")

        if server_dir not in ('.', '/'):
            try:
                ftp.cwd(server_dir)
                print(f"Changed remote directory to: {ftp.pwd()}")
            except Exception as e:
                print(f"Notice: Could not cd to '{server_dir}' ({e}). Remaining in '{ftp.pwd()}'.")

        # Test listing
        print("\nListing remote directory:")
        remote_files = []
        ftp.retrlines('NLST', remote_files.append)
        print(f"Found {len(remote_files)} entries in current remote directory.")

        # Upload files: upload unpacker and token first to confirm write permissions
        files_to_upload = ['deploy_unpacker.php', '.deploy_token', 'deploy.zip']

        for filename in files_to_upload:
            if not os.path.exists(filename):
                print(f"Warning: Local file '{filename}' does not exist, skipping.")
                continue

            file_size = os.path.getsize(filename)
            size_mb = file_size / (1024 * 1024)
            print(f"\n---> Uploading '{filename}' ({size_mb:.2f} MB)...")

            uploaded_bytes = 0
            start_time = time.time()
            last_reported_mb = 0

            def progress_callback(chunk):
                nonlocal uploaded_bytes, last_reported_mb
                uploaded_bytes += len(chunk)
                current_mb = uploaded_bytes / (1024 * 1024)
                if current_mb - last_reported_mb >= 10 or uploaded_bytes == file_size:
                    elapsed = max(time.time() - start_time, 0.1)
                    speed_mbps = (uploaded_bytes / (1024 * 1024)) / elapsed
                    pct = (uploaded_bytes / file_size) * 100 if file_size else 100
                    print(f"     [{pct:5.1f}%] {current_mb:6.1f} / {size_mb:6.1f} MB  ({speed_mbps:.2f} MB/s)")
                    last_reported_mb = current_mb

            # Always fresh upload with STOR
            with open(filename, 'rb') as f:
                ftp.storbinary(f'STOR {filename}', f, blocksize=1024 * 1024, callback=progress_callback)

            print(f"---> Successfully uploaded '{filename}' in {time.time() - start_time:.1f}s!")

        ftp.quit()
        print("\nAll files uploaded successfully via FTP!")

    except error_perm as ep:
        print(f"\n[FTP PERMISSION ERROR 5xx]: {ep}", file=sys.stderr)
        sys.exit(1)
    except error_temp as et:
        print(f"\n[FTP TEMPORARY ERROR 4xx]: {et}", file=sys.stderr)
        sys.exit(1)
    except Exception as e:
        print(f"\n[FTP CONNECTION ERROR]: {e}", file=sys.stderr)
        sys.exit(1)

if __name__ == '__main__':
    main()
