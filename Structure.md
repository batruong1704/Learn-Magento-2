+) Clear cache:
php bin/magento cache:flush
+) Upgrache: => Remember drop table helloworld in mysql, add version in module.xml
php bin/magento setup:upgrade


# I. Magento 2 directory structure
## 1.1. App
Folder bao gồm các file cối lõi của Magento 2, chứa các file config, modules và themes
## 1.2. Bin
Nó bao gồm các file thực thi liên quan tới quản lý hệ thống và các công cụ dòng lệnh
bin/magento là file thực thi chính để quản lý Magento thông qua dòng lệnh
bin/setup là thư mục chứa các file liên quan tới việc install và update hệ thống
## 1.3. Generated
Lưu trữ các file tạo ra tự động trong quá trình chạy, bao gồm các file tạo từ mã nguồn, extension, data tạo ra trong quá trình chạy
## 1.4. Pub
Chứa các file css, js, image có thể truy cập trực tiếp từ bên ngoài
## 1.5. Var
Lữu trữ các dữ liêu tạm thời và các file log, file sessions thô, cache, database backups và báo cáo lỗi được lưu trong cache
nó tái sinh nội dung từ nhiều thư mục con khi chạy trên command 
## 1.6. Vendor
Composer tạo ra thư mục vendor nhằm sử dụng các file composer.json. Folder này bao gồm các thư mục và gói phần mềm bên ngoài mà magento sử dụng và chúng được xác định dưới file composer.json. 

# II. Module file structure
## 2.1. Common directory
- Block: là thành phần UI nhằm hiển thị dữ liệu và tương tác với người dùng. Là 1 phần nhất định của nhiều page web sử dụng lại như header, form, … (PHP view)
- Controller: xử lý các yêu cầu HTTP từ phía người dùng và điều hướng chúng tới các hành động cụ thể trong module như hiển thị trang web, xử lý form và thực thi các tác vụ liên quan tới logic (PHP controller)
- etc: chứa các file cấu hình như:
	+ Module.xml: chứa các thông tin cơ bản về module như tên, phiên bản, trạng thái. nhờ file này magento biết được sự tồn tại của module và các quản lý nó
	+ Di.xml: chứa cấu hình để tiêm (Dependency Injection) nhằm quản lý và cấu hình các đối tượng và các phụ thuộc giữa chúng
	+ Events.xml: chứa các file đăng ký sự kiện
	+ Routes.xml: định nghĩa các routes và các controllers cho module
	+ Acl.xml: các cấu hình điều khiển truy cập (Access control list) để định nghĩa quyền truy cập cho các phần của module
	+ System.xml: chứa các file cấu hình cho trang System Configuration. định nghĩa các trường cài đặt, nhóm và section liên quan
	+ Config.xml: Chứa các cấu hình chung của module như khai báo của các model, block, helper và các cấu hình khác
- Model: xử lý logic và tương tác với dữ liệu
	+ Resource Model: sử dụng để thực thi các truy vấn và thao tác CRUD
	+ Collection.php: sử dụng để thực thi các truy vấn và lọc dữ liệu từ csdl
- Setup: giúp quản lý cấu trúc và dữ liệu mẫu trong csdl => nhớ thay đổi phiên sau mỗi cần cập nhật
	```
	php bin/magento setup:upgrade
	```


| **File**              | **Mục Đích**               | **Thời Điểm Thực Thi**		|
|-----------------------|----------------------------|----------------------------------|
| **InstallSchema**     | Định nghĩa cấu trúc csdl. | Chỉ chạy lần đầu | 
| **InstallData**       | Thêm dữ liệu mẫu vào csdl | Chỉ chạy lần đầu.             |
| **UpgradeSchema**     | Thay đổi cấu trúc csdl.   | Chạy mỗi khi module được cập nhật.   | 
| **UpgradeData**       | Thêm hoặc cập nhật dữ liệu mẫu.      | Chạy mỗi khi module được cập nhật.   |

### **Cây cấu trúc**
	
	- HelloWorld:
	  -- Block:
	  -- Controller(2):
	    --- Adminhtml:
		---- Post: Index.php
	    --- Other File...
	  -- etc (2.4):
	    --- adminhtml(3):
		---- menu.xml
		---- routes.xml
		---- system.xml
	    --- frontend(2):
		---- events.xml
		---- routes.xml
	    --- acl.xml
	    --- config.xml
	    --- di.xml
	    --- module.xml
	  -- Model(1.1):
	    --- ResourceModel (1.1)
		---- Post: Conllection.php
		---- Post.php
	    --- Post.php
	  -- Observer: 
	  -- Plugin:
	  -- Setup(.4):
	    --- InstallData.php
	    --- InstallSchema.php
	    --- UpgradeData.php
	    --- UpgradeSchema.php
	  -- view(2):
	    --- adminhtml(2):
		---- layout: myid_post_index.xml
		---- ui_conponent: magento_helloworld_post_listing.xml
	    --- frontend(2):
		---- layout: myid_index_test.xml
		---- templates: test.phtml
