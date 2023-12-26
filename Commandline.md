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

# Struction
## 1.1. App
  Folder bao gồm các file cối lõi của Magento 2 như module, template, thêm, ngôn ngữ, tệp cấu hình và các thiết lập mặc định của hệ thống. Chúng bao gồm các folder con sau:
  - code: chứa module của magento
  - design: chứa các template và skin của module
  - etc: chứa các tệp cấu hình
## 1.2. Bin
  Folder chứa các tập lệnh CLI được sử dụng để quản lý Magento như magento setup, index, ...
## 1.3. Generated
  Chứa các tệp được tạo ra tự động bởi magento như tệp cấu hình và tệp dịch
## 1.4. Pub
  Chứa các tệp phục vụ cho người dùng như html, css, js và image
## 1.5. Var
  Lữu trữ các dữ liêu tạm thời và các file log, file sessions thô, cache, database backups và báo cáo lỗi được lưu trong cache. Nó tái sinh nội dung từ nhiều thư mục con khi chạy trên command.
## 1.6. Vendor
  Composer tạo ra thư mục vendor nhằm sử dụng các file composer.json. Folder này bao gồm các thư mục và gói phần mềm bên ngoài mà magento sử dụng và chúng được xác định dưới file composer.json. 
