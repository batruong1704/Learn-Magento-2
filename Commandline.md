# Command Line

1. **`bin/magento setup:upgrade`**: Cập nhật cơ sở dữ liệu và thực hiện các thay đổi cần thiết sau khi bạn cài đặt hoặc cập nhật extension.

2. **`bin/magento setup:di:compile`**: Biên dịch và tạo các đối tượng DI (Dependency Injection). Thực hiện sau khi thay đổi trong các lớp PHP hoặc khi bạn cài đặt mới extension.

3. **`bin/magento setup:static-content:deploy`**: Triển khai tất cả các tài nguyên tĩnh như CSS, JavaScript từ các extension và Magento core. Thực hiện khi triển khai vào môi trường sản phẩm hoặc khi có thay đổi trong tài nguyên tĩnh.

4. **`bin/magento cache:clean`**: Xóa toàn bộ cache Magento.

5. **`bin/magento cache:flush`**: Xóa toàn bộ cache Magento và tái tạo lại.

6.  **`bin/magento cache:<disable>`**: Tắt toàn bộ cache trong Magento.

7.  **`bin/magento indexer:reindex`**: Tái tạo tất cả các index trong Magento.

8.  **`bin/magento maintenance:<enable>`**: Bật chế độ bảo trì, tạm dừng trang web để thực hiện các công việc bảo trì.

9.  **`bin/magento module:status`**:  Hiển thị trạng thái của các modules.

10. **`bin/magento module:<enable> Module_Name`**: Kích hoạt một module Magento.







# Cách cập nhật lại module sau khi xóa đi và cần lấy lại
```php
php bin/magento s:d:c
php bin/magento s:s:d -f
php bin/magento cache:flush
```