+) Clear cache:
```angular2html
php bin/magento cache:flush
```

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

| **File**              | **Mục Đích**                    | **Thời Điểm Thực Thi**		|
|:----------------------|:--------------------------------|----------------------------------|
| **InstallSchema**     | Định nghĩa cấu trúc csdl.       | Chỉ chạy lần đầu | 
| **InstallData**       | Thêm dữ liệu mẫu vào csdl       | Chỉ chạy lần đầu.             |
| **UpgradeSchema**     | Thay đổi cấu trúc csdl.         | Chạy mỗi khi module được cập nhật.   | 
| **UpgradeData**       | Thêm hoặc cập nhật dữ liệu mẫu. | Chạy mỗi khi module được cập nhật.   |

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

# C. Inplementation Step Update
```php
php bin/magento s:d:c
php bin/magento s:s:d -f
php bin/magento cache:flush
```
# D. Implementation Step Create New Module
## 1. Create Routes and Controller
### *Step 1:* Create the folder of Demo module
Tạo 1 folder mới theo đường dẫn: `app/code/Magento/Demo`
### *Step 2:* Create `etc/module.xml` file.
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
	<module name="Magento_Demo" setup_version="1.0.0" />
</config>
```
TODO: file `module.xml` chứa các thông tin cơ bản về module như tên, phiên bản, trạng thái. nhờ file này magento biết được sự tồn tại của module và các quản lý nó.
### *Step 3:* Create registration.php file
```php
<?php
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Magento_Demo',
    __DIR__
);
```
TODO: file `registration.php` sử dụng để đăng ký module

### *Step 4:* Enable the module
```cmd
php bin/magento module:status
php bin/magento module:enable Magento_Demo 
php bin/magento setup:upgrade
```
TODO: 
- Thay đổi của cấu hình sẽ được lưu tại etc/config.xml
- Ta có thể kiểm tra lại từ localhost trên setup_module

### *Step 5:* Create file etc/routes.php
```xml
<?xml version="1.0" ?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
    <router id="standard">
        <route frontName="demo" id="iddemo">
            <module name="Magento_Demo"/>
        </route>
    </router>
</config>
```
TODO: 
- `<route id="myroute" frontName="custom">`: Định nghĩa một route với `id` là "iddemo" và `frontName` là "demo". `FrontName` là phần của URL mà bạn sẽ sử dụng để truy cập vào route này từ frontend còn `id` sẽ được sử dụng ở backend.
- `<module name="Magento_Demo"/>`: Cho biết module nào sẽ xử lý yêu cầu từ route này. 
- Kiểm tra tại url sau: `http://magento2.loc/demo/index/index`

## 2. Create Layout, Block, Template
### 2.1. Block
```php
<?php
namespace Magento\Demo\Block;
class Test extends \Magento\Framework\View\Element\Template
{
    public function getName(){
        return 'Buck';
    }
}
```
TODO: `Block` cung cấp dữ liệu cho `layout` và `templates`

### 2.2. Layout (view/frontend/layout)
Tạo file iddemo_index_test.xml, trong file này gồm 3 thành phần ngăn cách bởi *index*:
- `iddemo`: là id mà bạn đã tạo ở routes.xml
- `test`: tên file nhận block này 
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <referenceContainer name="content">
        <block class="Magento\Demo\Block\Demo" name="Helloworld_index_test" template="Magento_Demo::test.phtml" />
        <block class="Magento\Demo\Block\Demo" name="Helloworld_index_test1" template="Magento_Demo::test.phtml" />
    </referenceContainer>
</page>
```
TODO: là file định nghĩa cấu trúc của trang web và xác định các block sẽ được hiển thị và sắp xếp 
trang. Layouts chứa thông tin về các blocks, templates, và các thành phần khác như containers và actions.

### 2.3. Templates (view/frontend/template)
```php
<h1><?php echo $block->getName(); ?></h1>
```
TODO: Templates chứa mã HTML và PHP để hiển thị nội dung trên trang web và mô tả cách dữ liệu từ block hiển thị.

Chú ý: Ta có thể gọi function từ Block bằng cách `$block->getFunctionName();`

**Các bước hoạt động:**
1. Yêu cầu từ trình duyệt. 
2. layouts xác định cấu trúc của trang web.
3. Block khi được gọi trong layouts, thực hiện phương thức toHtml() để lấy dữ liệu từ csdl, xử lý logic kinh doanh, và trả về mã HTML.
4. Dữ liệu từ block được truyền vào template để hiển thị nội dung.
5. Khi các khối đã được xử lý và templates đã được kết nối, Magento tạo ra mã HTML hoàn chỉnh.

## 3. Install Schema and Data
Tạo folder setup chứa các file con sau:
### 3.1. InstallSchema.php
```php
<?php
namespace Magento\Demo\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface {
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context) {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('demo_magento')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('demo_magento')
            )
                ->addColumn(
                    'post_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Post ID'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Post Name'
                )
                ->addColumn(
                    'url_key',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post URL Key'
                )
                ->addColumn(
                    'post_content',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Post Post Content'
                )
                ->addColumn(
                    'tags',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Tags'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    1,
                    [],
                    'Post Status'
                )
                ->addColumn(
                    'featured_image',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Featured Image'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At')
                ->setComment('Post Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
```

### 3.2. InstallData.php 
```php
<?php
namespace Magento\Demo\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        $data = [
            'name'         => "How to Create SQL Setup Script in Magento 2",
            'post_content' => "In this article, we will find out how to install and upgrade sql script for module in Magento 2. When you install or upgrade a module, you may need to change the database structure or add some new data for current table. To do this, Magento 2 provide you some classes which you can do all of them.",
            'url_key'      => '/magento-2-module-development/magento-2-how-to-create-sql-setup-script.html',
            'tags'         => 'magento 2,mageplaza helloworld',
            'status'       => 1
        ];
        $table = $setup->getTable('demo_magento');
        $setup->getConnection()->insert($table, $data);
        $setup->endSetup();
    }
}
```

### 3.3. UpgradeSchema.php 
```php
<?php
namespace Magento\Demo\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();
        if(version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$installer->tableExists('demo_magento')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('demo_magento')
                )
                    ->addColumn(
                        'post_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Post ID'
                    )
                    ->addColumn(
                        'name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Post Name'
                    )
                    ->addColumn(
                        'url_key',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post URL Key'
                    )
                    ->addColumn(
                        'post_content',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        '64k',
                        [],
                        'Post Post Content'
                    )
                    ->addColumn(
                        'tags',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post Tags'
                    )
                    ->addColumn(
                        'status',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        1,
                        [],
                        'Post Status'
                    )
                    ->addColumn(
                        'featured_image',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post Featured Image'
                    )
                    ->addColumn(
                        'created_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At')
                    ->setComment('Post Table');
                $installer->getConnection()->createTable($table);
            }
        }
        $installer->endSetup();
    }
}
```

### 3.4. UpgradeSchema.php
```php
<?php
namespace Magento\Demo\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();
        if(version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$installer->tableExists('demo_magento')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('demo_magento')
                )
                    ->addColumn(
                        'post_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Post ID'
                    )
                    ->addColumn(
                        'name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Post Name'
                    )
                    ->addColumn(
                        'url_key',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post URL Key'
                    )
                    ->addColumn(
                        'post_content',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        '64k',
                        [],
                        'Post Post Content'
                    )
                    ->addColumn(
                        'tags',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post Tags'
                    )
                    ->addColumn(
                        'status',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        1,
                        [],
                        'Post Status'
                    )
                    ->addColumn(
                        'featured_image',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post Featured Image'
                    )
                    ->addColumn(
                        'created_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At')
                    ->setComment('Post Table');
                $installer->getConnection()->createTable($table);
            }
        }
        $installer->endSetup();
    }
}
```
TODO: Trước khi thực thi, hãy xóa file đã tạo mẫu trước. Sau mỗi lần muốn upgrade cần tăng version.
```cmd 
php bin/magento setup:upgrade
```

### 4. Create Model
Tạo file `Post.php` để định nghĩa 1 module:
```php
<?php
namespace Magento\Demo\Model;
class Post extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Magento\HelloWorld\Model\ResourceModel\Post::class);
    }
}
```

Tạo Folder ResourceModel, trong đó bao gồm các file:
- Post.php:
	```php
	<?php
	namespace Magento\HelloWorld\Model\ResourceModel;
	
	class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
		protected function _construct() {
		$this->_init('magento_helloworld_post', 'post_id');
		}
	}
	```
 

# 5. ACL
Trong etc/acl.xml:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Acl/etc/acl.xsd">
    <acl>
        <resources>
            <resource id="Magento_Backend::admin">
                <resource id="Magento_Demo::demo" title="My Demo" sortOrder="51">
                    <resource id="Magento_Demo::post" title="Posts" sortOrder="10"/>
                </resource>

                <resource id="Magento_Backend::stores">
                    <resource id="Magento_Backend::stores_settings">
                        <resource id="Magento_Config::config">
                            <resource id="Magento_Demo::demo_configuration" title="My Demo"/>
                        </resource>
                    </resource>
                </resource>
            </resource>
        </resources>
    </acl>
</config>
```

# 6. Create Menu
Trong etc/adminhtml/menu.xml:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Backend:etc/menu.xsd">
    <menu>
        <add id="Magento_Demo::iddemo"
             title="My Demo"
             module="Magento_Demo"
             sortOrder="51"
             resource="Magento_HelloWorld::helloworld"/>

        <add id="Magento_Demo::post_id"
             title="Manage Posts"
             module="Magento_Demo"
             sortOrder="10"
             action="my_front_mame/post/index"
             resource="Magento_Demo::post"
             parent="Magento_Demo::iddemo"/>

        <add id="Magento_Demo::hello_configuration_id"
             title="Configuration"
             module="Magento_Demo"
             sortOrder="5"
             parent="Magento_Demo::iddemo"
             action="adminhtml/system_config/edit/section/helloworld_section_id"
             resource="Magento_Demo::demo_configuration"/>
    </menu>
</config>
```
Trong đó:
- Id: định danh file 
- title: tên được dùng để hiển thị 
- sortOrder: thứ tự sắp xếp 
- resource: nguồn, đối chiếu từ file ACL.xml
- parent: xác định lớp cha 
- action: url chuyển tiếp trang 

# 7. Create configuration
Trong etc/adminhtml/system.xml:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Config:etc/system_file.xsd">
    <system>
        <tab id="Magento_Demo" translate="label" sortOrder="10">
            <label>Magento</label>
        </tab>
        <section id="demo_section_id" translate="label" sortOrder="130" showInDefault="1" showInWebsite="1" showInStore="1">
            <class>separator-top</class>
            <label>Hello World</label>
            <tab>Magento_HelloWorld</tab>
            <resource>Magento_Demo::demo_configuration</resource>
            <group id="general" translate="label" type="text" sortOrder="10" showInDefault="1" showInWebsite="1" showInStore="1">
                <label>General Configuration</label>
                <field id="enable" translate="label" type="select" sortOrder="1" showInDefault="1" showInWebsite="1" showInStore="1">
                    <label>Module Enable</label>
                    <source_model>Magento\Config\Model\Config\Source\Yesno</source_model>
                </field>
                <field id="display_text" translate="label" type="text" sortOrder="1" showInDefault="1" showInWebsite="0" showInStore="1" canRestore="1">
                    <label>Display Text</label>
                    <comment>This text will display on the frontend.</comment>
                </field>
                <group id="general_test_child" translate="label" type="text" sortOrder="10" showInDefault="1" showInWebsite="1" showInStore="1">
                    <label>Test</label>
                    <field id="display_text" translate="label" type="text" sortOrder="1" showInDefault="1" showInWebsite="0" showInStore="1" canRestore="1">
                        <label>Display Text</label>
                        <comment>This text will display on the frontend.</comment>
                    </field>
                </group>
            </group>
        </section>
    </system>
</config>
```

TODO: Chú ý vào section và resource phải khớp với file menu để có thể trỏ vào.

Trong etc/config.xml, file này sẽ lưu các giá trị mặc định cho system.xml:
```xml 
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Store:etc/config.xsd">
    <default>
        <helloworld_section_id>
            <general>
                <enable>1</enable>
                <display_text>Hello World</display_text>
                <general_test_child>
                    <display_text>Đây là gìá trị mặc định từ file config.xml</display_text>
                </general_test_child>
            </general>
        </helloworld_section_id>
    </default>
</config>
```

# 8. Create Admin Grid

Tạo file Controller/Adminhtml/Post/Index.php:
```php
<?php

namespace Magento\Demo\Controller\Adminhtml\Post;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
//        die(__METHOD__);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));
        return $resultPage;
    }
    
}
```

Trong `etc/adminhtml/routes.xml`, lưu ý về `frontName` và `id` này sẽ sử dụng cho admin:
```xml 
<?xml version="1.0" ?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
    <router id="admin">
        <route frontName="my_demo_for_admin" id="iddemo">
            <module name="Magento_Demo"/>
        </route>
    </router>
</config>
```

Trong `etc/di.xml`, lưu ý rằng mainTable là tên của bảng cần lấy data:
```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/ObjectManager/etc/config.xsd">
    <type name="Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory">
        <arguments>
            <argument name="collections" xsi:type="array">
                <item name="post_listing_data_source" xsi:type="string">WorldVirtualType</item>
            </argument>
        </arguments>
    </type>

    <virtualType name="WorldVirtualType" type="Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult">
        <arguments>
            <argument name="mainTable" xsi:type="string">demo_magento</argument>
            <argument name="resourceModel" xsi:type="string">Magento\Demo\Model\ResourceModel\Post</argument>
        </arguments>
    </virtualType>
</config>
```

Trong `view/adminhtml/layout/iddemo_post/index.xml`, lưu ý rằng 3 / cuối lần lượt là id (lấy từ routes), folder ở controller và action:
```xml 
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../../../lib/internal/Magento/Framework/View/Layout/etc/page_configuration.xsd">
	<update handle="styles"/>
	<body>
		<referenceContainer name="content">
			<uiComponent name="post_listing"/>
		</referenceContainer>
	</body>
</page>
```

Trong `view/ui_component/post_listing.xml`, đây là file hiển thị lên UI:
```xml 
<listing xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Ui:etc/ui_configuration.xsd">
    <argument name="data" xsi:type="array">
        <item name="js_config" xsi:type="array">
            <item name="provider" xsi:type="string">post_listing.post_listing_data_source</item>
            <item name="deps" xsi:type="string">post_listing.post_listing_data_source</item>
        </item>
        <item name="spinner" xsi:type="string">spinner_columns</item>
        <item name="buttons" xsi:type="array">
            <item name="add" xsi:type="array">
                <item name="name" xsi:type="string">add</item>
                <item name="label" xsi:type="string" translate="true">Add New Post</item>
                <item name="class" xsi:type="string">primary</item>
                <item name="url" xsi:type="string">my_front_mame/post/new</item>
            </item>
        </item>
    </argument>
    <listingToolbar name="listing_top">
        <bookmark name="bookmarks"/>
        <columnsControls name="columns_controls"/>
        <filterSearch name="fulltext"/>
        <filters name="listing_filters" />
        <paging name="listing_paging"/>
        <exportButton name="export_button"/>

        <massaction name="listing_massaction">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/tree-massactions</item>
                </item>
            </argument>
            <action name="delete">
                <argument name="data" xsi:type="array">
                    <item name="config" xsi:type="array">
                        <item name="type" xsi:type="string">delete</item>
                        <item name="label" xsi:type="string" translate="true">Delete</item>
                        <item name="url" xsi:type="url" path="mageplaza_helloworld/post/massDelete"/>
                        <item name="confirm" xsi:type="array">
                            <item name="title" xsi:type="string" translate="true">Delete Post</item>
                            <item name="message" xsi:type="string" translate="true">Are you sure you wan't to delete selected items?</item>
                        </item>
                    </item>
                </argument>
            </action>
        </massaction>
    </listingToolbar>
    <dataSource name="zzzzzzzz">
        <argument name="dataProvider" xsi:type="configurableObject">
            <argument name="class" xsi:type="string">Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider</argument>
            <argument name="name" xsi:type="string">post_listing_data_source</argument>
            <argument name="primaryFieldName" xsi:type="string">post_id</argument>
            <argument name="requestFieldName" xsi:type="string">id</argument>
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/provider</item>
                    <item name="update_url" xsi:type="url" path="mui/index/render"/>
                    <item name="storageConfig" xsi:type="array">
                        <item name="indexField" xsi:type="string">post_id</item>
                    </item>
                </item>
            </argument>
        </argument>
    </dataSource>
    <columns name="spinner_columns">
        <selectionsColumn name="ids">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="resizeEnabled" xsi:type="boolean">false</item>
                    <item name="resizeDefaultWidth" xsi:type="string">55</item>
                    <item name="indexField" xsi:type="string">post_id</item>
                </item>
            </argument>
        </selectionsColumn>
        <column name="post_id">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">textRange</item>
                    <item name="sorting" xsi:type="string">asc</item>
                    <item name="label" xsi:type="string" translate="true">ID</item>
                </item>
            </argument>
        </column>
        <column name="url_key">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">textRange</item>
                    <item name="sorting" xsi:type="string">asc</item>
                    <item name="label" xsi:type="string" translate="true">Url Key</item>
                </item>
            </argument>
        </column>
        <column name="name">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">text</item>
                    <item name="editor" xsi:type="array">
                        <item name="editorType" xsi:type="string">text</item>
                        <item name="validation" xsi:type="array">
                            <item name="required-entry" xsi:type="boolean">true</item>
                        </item>
                    </item>
                    <item name="label" xsi:type="string" translate="true">Name</item>
                </item>
            </argument>
        </column>
        <column name="created_at" class="Magento\Ui\Component\Listing\Columns\Date">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">dateRange</item>
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/columns/date</item>
                    <item name="dataType" xsi:type="string">date</item>
                    <item name="label" xsi:type="string" translate="true">Created</item>
                </item>
            </argument>
        </column>
        <column name="updated_at" class="Magento\Ui\Component\Listing\Columns\Date">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="filter" xsi:type="string">dateRange</item>
                    <item name="component" xsi:type="string">Magento_Ui/js/grid/columns/date</item>
                    <item name="dataType" xsi:type="string">date</item>
                    <item name="label" xsi:type="string" translate="true">Modified</item>
                </item>
            </argument>
        </column>
    </columns>
</listing>
```







