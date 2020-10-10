<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	$GLOBALS['page_title'] = $Translation['view or rebuild fields'];
	include("{$currDir}/incHeader.php");

	/*
		$schema: [ tablename => [ fieldname => [ appgini => '...', 'db' => '...'], ... ], ... ]
	*/

	/* application schema as created in AppGini */
	$schema = array(
		'Customers' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Title' => array('appgini' => 'VARCHAR(40) null '),
			'Customer' => array('appgini' => 'VARCHAR(40) null '),
			'Birthdate' => array('appgini' => 'DATE null '),
			'Type' => array('appgini' => 'INT unsigned null '),
			'Phone' => array('appgini' => 'VARCHAR(40) null '),
			'Email' => array('appgini' => 'VARCHAR(80) null '),
			'Address' => array('appgini' => 'VARCHAR(40) null '),
			'City' => array('appgini' => 'INT unsigned null '),
			'Province' => array('appgini' => 'INT unsigned null '),
			'Country' => array('appgini' => 'INT unsigned null '),
			'Status' => array('appgini' => 'VARCHAR(40) null default \'ACTIVE\' '),
		),
		'Retention' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Phone' => array('appgini' => 'INT unsigned null '),
			'Email' => array('appgini' => 'INT unsigned null '),
			'Zone' => array('appgini' => 'INT unsigned null '),
			'Interaction' => array('appgini' => 'TEXT null '),
			'GIFTPACKAGE' => array('appgini' => 'TEXT null '),
			'Assigned' => array('appgini' => 'INT unsigned null '),
			'Status' => array('appgini' => 'VARCHAR(40) null default \'OPEN\' '),
			'CreateDate' => array('appgini' => 'DATETIME null '),
			'ResolutionDate' => array('appgini' => 'DATETIME null '),
		),
		'Alert' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Satus' => array('appgini' => 'VARCHAR(40) null '),
			'Comment' => array('appgini' => 'TEXT null '),
			'Date' => array('appgini' => 'DATETIME null '),
		),
		'CustomerClass' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Type' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Staff' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Photo' => array('appgini' => 'VARCHAR(40) null '),
			'Employee' => array('appgini' => 'VARCHAR(40) null '),
			'Birthdate' => array('appgini' => 'DATE null '),
			'Phone' => array('appgini' => 'VARCHAR(40) null '),
			'Email' => array('appgini' => 'VARCHAR(80) null '),
			'Address' => array('appgini' => 'VARCHAR(40) null '),
			'City' => array('appgini' => 'INT unsigned null '),
			'Province' => array('appgini' => 'INT unsigned null '),
			'Country' => array('appgini' => 'INT unsigned null '),
			'hireDate' => array('appgini' => 'DATE null '),
			'Department' => array('appgini' => 'INT unsigned null '),
			'Position' => array('appgini' => 'INT unsigned null '),
			'Supervisor' => array('appgini' => 'INT unsigned null '),
			'Manager' => array('appgini' => 'INT unsigned null '),
			'Director' => array('appgini' => 'INT unsigned null '),
			'Status' => array('appgini' => 'VARCHAR(40) null '),
			'EmergencyContact' => array('appgini' => 'TEXT null '),
			'EmergencyPhone' => array('appgini' => 'TEXT null '),
			'userName' => array('appgini' => 'VARCHAR(40) not null '),
		),
		'Country' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Country' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Province' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Province' => array('appgini' => 'VARCHAR(40) null '),
			'Country' => array('appgini' => 'INT unsigned null '),
		),
		'City' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Province' => array('appgini' => 'INT unsigned null '),
			'City' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Warehouse' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Warehouse' => array('appgini' => 'VARCHAR(40) null '),
			'Date' => array('appgini' => 'DATE null '),
			'Freight' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Tracking' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'WhID' => array('appgini' => 'INT unsigned null '),
			'Date' => array('appgini' => 'INT unsigned null default \'1\' '),
			'Warehouse' => array('appgini' => 'INT unsigned null '),
			'Tracking' => array('appgini' => 'VARCHAR(40) null '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Dimensions' => array('appgini' => 'VARCHAR(40) null '),
			'Weight' => array('appgini' => 'DECIMAL(10,2) null '),
			'Volume' => array('appgini' => 'DECIMAL(10,2) null '),
			'Total' => array('appgini' => 'DECIMAL(10,2) null '),
			'Employee' => array('appgini' => 'INT unsigned null '),
			'Freight' => array('appgini' => 'INT unsigned null '),
			'Status' => array('appgini' => 'VARCHAR(40) null default \'READY FOR PICK UP\' '),
			'Zone' => array('appgini' => 'INT unsigned null '),
			'DeliveredDate' => array('appgini' => 'DATETIME null '),
		),
		'Status' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'TrackID' => array('appgini' => 'INT unsigned null '),
			'Invoice' => array('appgini' => 'INT unsigned null '),
			'Tracking' => array('appgini' => 'INT unsigned null '),
			'Dimensions' => array('appgini' => 'INT unsigned null '),
			'RWeight' => array('appgini' => 'INT unsigned null '),
			'VWeight' => array('appgini' => 'INT unsigned null '),
			'Total' => array('appgini' => 'INT unsigned null '),
			'FreightType' => array('appgini' => 'VARCHAR(40) not null '),
			'DeliveryDate' => array('appgini' => 'DATETIME null '),
			'Delivered' => array('appgini' => 'BLOB null '),
		),
		'Invoice' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'type' => array('appgini' => 'VARCHAR(40) null default \'Quote\' '),
			'number' => array('appgini' => 'INT not null '),
			'Date' => array('appgini' => 'DATE null '),
			'Title' => array('appgini' => 'INT unsigned null '),
			'Customer' => array('appgini' => 'INT unsigned not null '),
			'Phone' => array('appgini' => 'INT unsigned null '),
			'Email' => array('appgini' => 'INT unsigned null '),
			'Address' => array('appgini' => 'INT unsigned null '),
			'City' => array('appgini' => 'INT unsigned null '),
			'Country' => array('appgini' => 'INT unsigned null '),
			'PaymentStatus' => array('appgini' => 'VARCHAR(40) null default \'UNPAID\' '),
			'AmountDUE' => array('appgini' => 'DECIMAL(10,2) null '),
			'AmountPAID' => array('appgini' => 'DECIMAL(10,2) null '),
			'Balance' => array('appgini' => 'DECIMAL(10,2) null '),
			'Status' => array('appgini' => 'VARCHAR(40) null default \'OPEN\' '),
			'tax' => array('appgini' => 'VARCHAR(40) null '),
			'Total' => array('appgini' => 'VARCHAR(40) null '),
			'usrAdd' => array('appgini' => 'VARCHAR(40) null '),
			'whenAdd' => array('appgini' => 'VARCHAR(40) null '),
			'usrUpdated' => array('appgini' => 'VARCHAR(40) null '),
			'whenUpdated' => array('appgini' => 'VARCHAR(40) null '),
			'related' => array('appgini' => 'INT unsigned null '),
		),
		'InvoiceDetails' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'invoice' => array('appgini' => 'INT unsigned null '),
			'order' => array('appgini' => 'INT null '),
			'product' => array('appgini' => 'INT unsigned null '),
			'qty' => array('appgini' => 'DECIMAL(10,2) not null '),
			'itemSale' => array('appgini' => 'INT unsigned null '),
			'SubTotal' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Products' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'code' => array('appgini' => 'VARCHAR(40) null '),
			'item' => array('appgini' => 'VARCHAR(40) null '),
			'cost' => array('appgini' => 'DECIMAL(10,2) null '),
			'profit' => array('appgini' => 'DECIMAL(10,2) null '),
			'itemSale' => array('appgini' => 'DECIMAL(10,2) null '),
			'uploads' => array('appgini' => 'TEXT null '),
		),
		'WHJournal' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Date' => array('appgini' => 'DATE null '),
			'Freightype' => array('appgini' => 'VARCHAR(40) null default \'AIR FREIGHT\' '),
			'Invoices' => array('appgini' => 'VARCHAR(40) null '),
			'Warehouse' => array('appgini' => 'VARCHAR(40) null '),
			'Tracking' => array('appgini' => 'VARCHAR(40) null '),
			'GroundFreight' => array('appgini' => 'TEXT null '),
			'Boxes' => array('appgini' => 'VARCHAR(40) null '),
			'Dimensions' => array('appgini' => 'VARCHAR(40) null '),
			'Volume' => array('appgini' => 'DECIMAL(10,2) null '),
			'Weight' => array('appgini' => 'DECIMAL(10,2) null '),
			'InternationalFreight' => array('appgini' => 'DECIMAL(10,2) null '),
			'LocalFreight' => array('appgini' => 'DECIMAL(10,2) null '),
			'Tip' => array('appgini' => 'DECIMAL(10,2) null '),
			'Total' => array('appgini' => 'DECIMAL(10,2) null '),
		),
		'CRM' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Interaction' => array('appgini' => 'VARCHAR(40) null default \'INBOUND\' '),
			'Inboundtype' => array('appgini' => 'VARCHAR(40) null default \'WHATSAPP\' '),
			'Type' => array('appgini' => 'VARCHAR(40) null '),
			'Description' => array('appgini' => 'TEXT null '),
			'Comments' => array('appgini' => 'TEXT null '),
			'Priority' => array('appgini' => 'VARCHAR(40) null '),
			'Status' => array('appgini' => 'VARCHAR(40) null '),
			'Timestamp' => array('appgini' => 'DATETIME null '),
			'Sent' => array('appgini' => 'BLOB null '),
			'Assigned' => array('appgini' => 'INT unsigned null '),
			'Url' => array('appgini' => 'VARCHAR(200) null '),
		),
		'Payroll' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'employee' => array('appgini' => 'INT unsigned null '),
			'date' => array('appgini' => 'DATE null '),
			'start' => array('appgini' => 'VARCHAR(40) null '),
			'stop' => array('appgini' => 'VARCHAR(40) null '),
			'horas' => array('appgini' => 'DECIMAL(10,2) null '),
			'comment' => array('appgini' => 'TEXT null '),
			'value' => array('appgini' => 'VARCHAR(40) null '),
			'status' => array('appgini' => 'VARCHAR(40) null default \'UNPAID\' '),
		),
		'Brand' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Brand' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Model' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Model' => array('appgini' => 'VARCHAR(40) null '),
			'Brand' => array('appgini' => 'INT unsigned null '),
		),
		'System' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'System' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Part' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Part' => array('appgini' => 'VARCHAR(40) null '),
			'System' => array('appgini' => 'INT unsigned null '),
		),
		'DatabaseAUTO' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Type' => array('appgini' => 'VARCHAR(40) null '),
			'Brand' => array('appgini' => 'INT unsigned null '),
			'Model' => array('appgini' => 'INT unsigned null '),
			'Year' => array('appgini' => 'VARCHAR(40) null '),
			'System' => array('appgini' => 'INT unsigned null '),
			'Part' => array('appgini' => 'INT unsigned null '),
			'PartNO' => array('appgini' => 'TEXT null '),
			'Dimensions' => array('appgini' => 'VARCHAR(40) null '),
			'Volume' => array('appgini' => 'DECIMAL(10,2) null '),
			'Weight' => array('appgini' => 'DECIMAL(10,2) null '),
			'AirFreight' => array('appgini' => 'DECIMAL(10,2) null '),
			'OceanFreight' => array('appgini' => 'DECIMAL(10,2) null '),
			'Picture' => array('appgini' => 'VARCHAR(40) null '),
		),
		'GeneralDB' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Description' => array('appgini' => 'TEXT null '),
			'Dimensions' => array('appgini' => 'VARCHAR(40) null '),
			'Vweight' => array('appgini' => 'DECIMAL(10,2) null '),
			'Rweight' => array('appgini' => 'DECIMAL(10,2) null '),
			'Ofreight' => array('appgini' => 'DECIMAL(10,2) null '),
			'Afreight' => array('appgini' => 'DECIMAL(10,2) null '),
			'photo' => array('appgini' => 'VARCHAR(40) null '),
		),
		'CustomerAuto' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'VehicleType' => array('appgini' => 'VARCHAR(40) null '),
			'VIN' => array('appgini' => 'TEXT null '),
			'Brand' => array('appgini' => 'INT unsigned null '),
			'Model' => array('appgini' => 'INT unsigned null '),
			'Year' => array('appgini' => 'INT unsigned null '),
			'EngineNo' => array('appgini' => 'TEXT null '),
			'Cylinder' => array('appgini' => 'VARCHAR(40) null '),
			'Liters' => array('appgini' => 'TEXT null '),
			'Transmission' => array('appgini' => 'VARCHAR(40) null '),
			'GEAR' => array('appgini' => 'VARCHAR(40) null '),
			'URL' => array('appgini' => 'TEXT null '),
		),
		'Compras' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Employee' => array('appgini' => 'INT unsigned null '),
			'Description' => array('appgini' => 'INT unsigned null '),
			'Url' => array('appgini' => 'VARCHAR(200) null '),
			'Total' => array('appgini' => 'DECIMAL(10,2) null '),
			'Odate' => array('appgini' => 'DATE null '),
			'ETA' => array('appgini' => 'DATE null '),
			'Status' => array('appgini' => 'VARCHAR(40) null default \'UNPAID\' '),
		),
		'TrackingCenter' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Date' => array('appgini' => 'DATE null '),
			'Name' => array('appgini' => 'INT unsigned not null '),
			'Zone' => array('appgini' => 'INT unsigned null '),
			'Tracking' => array('appgini' => 'INT unsigned not null '),
			'Carrier' => array('appgini' => 'VARCHAR(40) null '),
			'Trackingurl' => array('appgini' => 'TEXT null '),
			'CustStatus' => array('appgini' => 'VARCHAR(40) null default \'OPEN\' '),
			'TRADEXXstatus' => array('appgini' => 'VARCHAR(40) null default \'OPEN\' '),
			'Freight' => array('appgini' => 'VARCHAR(40) null '),
			'Comments' => array('appgini' => 'TEXT null '),
		),
		'Claim' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Date' => array('appgini' => 'DATE null '),
			'Invoice' => array('appgini' => 'TEXT null '),
			'Warehouse' => array('appgini' => 'INT unsigned null '),
			'Tracking' => array('appgini' => 'INT unsigned null '),
			'Selecteds' => array('appgini' => 'VARCHAR(40) null '),
			'Shippingt' => array('appgini' => 'VARCHAR(40) null '),
			'Status' => array('appgini' => 'VARCHAR(40) not null '),
		),
		'Activities' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Date' => array('appgini' => 'DATE null '),
			'Description' => array('appgini' => 'TEXT null '),
			'Comment' => array('appgini' => 'TEXT null '),
			'Priority' => array('appgini' => 'VARCHAR(40) null '),
			'Assigned' => array('appgini' => 'INT unsigned null '),
			'Completed' => array('appgini' => 'BLOB null '),
			'Stop' => array('appgini' => 'DATETIME null '),
		),
		'Return' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Date' => array('appgini' => 'DATE null '),
			'Invoice' => array('appgini' => 'TEXT null '),
			'Warehouse' => array('appgini' => 'INT unsigned null '),
			'Tracking' => array('appgini' => 'INT unsigned null '),
			'Shippingt' => array('appgini' => 'VARCHAR(40) null '),
			'Status' => array('appgini' => 'VARCHAR(40) not null '),
			'Amount' => array('appgini' => 'DECIMAL(10,2) null '),
			'Refund' => array('appgini' => 'BLOB null '),
		),
		'Department' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Department' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Position' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Position' => array('appgini' => 'VARCHAR(40) null '),
			'Department' => array('appgini' => 'INT unsigned null '),
		),
		'CEO' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Chief' => array('appgini' => 'VARCHAR(40) null '),
			'Department' => array('appgini' => 'INT unsigned null '),
		),
		'Manager' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Manager' => array('appgini' => 'VARCHAR(40) null '),
			'Department' => array('appgini' => 'INT unsigned null '),
		),
		'Supervisor' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Supervisor' => array('appgini' => 'VARCHAR(40) null '),
			'Department' => array('appgini' => 'INT unsigned null '),
		),
		'Losses' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Description' => array('appgini' => 'TEXT null '),
			'Saleprice' => array('appgini' => 'DECIMAL(10,2) null '),
			'OperationCost' => array('appgini' => 'DECIMAL(10,2) null '),
			'Lost' => array('appgini' => 'DECIMAL(10,2) null '),
			'Comment' => array('appgini' => 'TEXT null '),
			'Recovered' => array('appgini' => 'DECIMAL(10,2) null '),
			'Balance' => array('appgini' => 'DECIMAL(10,2) null '),
			'Status' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Subscriptions' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Vendor' => array('appgini' => 'VARCHAR(40) null '),
			'AccountID' => array('appgini' => 'TEXT null '),
			'LastPayment' => array('appgini' => 'DATE null '),
			'DueDate' => array('appgini' => 'DATE null '),
			'Status' => array('appgini' => 'VARCHAR(40) null '),
			'Rate' => array('appgini' => 'DECIMAL(10,2) null '),
			'AmountDue' => array('appgini' => 'DECIMAL(10,2) null '),
		),
		'Accounting' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'invoice' => array('appgini' => 'INT unsigned null '),
			'date' => array('appgini' => 'DATE null '),
			'description' => array('appgini' => 'TEXT null '),
			'account_plan' => array('appgini' => 'INT unsigned null '),
			'master_account' => array('appgini' => 'INT unsigned null '),
			'account' => array('appgini' => 'INT unsigned null '),
			'sub_account' => array('appgini' => 'INT unsigned null '),
			'type' => array('appgini' => 'INT unsigned null '),
			'amount' => array('appgini' => 'DECIMAL(10,2) null '),
			'balance' => array('appgini' => 'DECIMAL(10,2) null '),
			'status' => array('appgini' => 'VARCHAR(40) null default \'OPEN\' '),
		),
		'AccountPlan' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'description' => array('appgini' => 'TEXT not null '),
			'code' => array('appgini' => 'VARCHAR(40) not null '),
			'master_account' => array('appgini' => 'INT unsigned not null '),
			'account' => array('appgini' => 'INT unsigned not null '),
			'sub_account' => array('appgini' => 'INT unsigned not null '),
			'type' => array('appgini' => 'INT unsigned not null '),
		),
		'MasterAccount' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'masterAccount' => array('appgini' => 'VARCHAR(40) null '),
			'code' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Account' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Account' => array('appgini' => 'VARCHAR(40) null '),
			'code' => array('appgini' => 'VARCHAR(40) null '),
		),
		'SubAccount' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'subAccount' => array('appgini' => 'VARCHAR(40) null '),
			'code' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Type' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'type' => array('appgini' => 'VARCHAR(40) null '),
		),
		'CCJournal' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Card' => array('appgini' => 'INT unsigned null '),
			'Date' => array('appgini' => 'DATE null '),
			'Description' => array('appgini' => 'TEXT null '),
			'Cleared' => array('appgini' => 'BLOB null '),
			'Amount' => array('appgini' => 'VARCHAR(40) null '),
			'Balance' => array('appgini' => 'DECIMAL(10,2) null '),
			'Logged' => array('appgini' => 'INT unsigned not null '),
			'Photo' => array('appgini' => 'VARCHAR(40) null '),
		),
		'CC' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Card' => array('appgini' => 'VARCHAR(40) null '),
		),
		'Receivable' => array(
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'Customer' => array('appgini' => 'INT unsigned null '),
			'Phone' => array('appgini' => 'INT unsigned null '),
			'Description' => array('appgini' => 'TEXT null '),
			'Interaction' => array('appgini' => 'TEXT null '),
			'ExpectedDate' => array('appgini' => 'DATE null '),
			'LastUpdate' => array('appgini' => 'DATETIME null '),
			'Status' => array('appgini' => 'VARCHAR(40) null default \'OPEN\' '),
			'Assigned' => array('appgini' => 'INT unsigned null '),
			'Amount' => array('appgini' => 'DECIMAL(10,2) null '),
		),
	);

	$table_captions = getTableList();

	/* function for preparing field definition for comparison */
	function prepare_def($def) {
		$def = strtolower($def);

		/* ignore 'null' */
		$def = preg_replace('/\s+not\s+null\s*/', '%%NOT_NULL%%', $def);
		$def = preg_replace('/\s+null\s*/', ' ', $def);
		$def = str_replace('%%NOT_NULL%%', ' not null ', $def);

		/* ignore length for int data types */
		$def = preg_replace('/int\s*\([0-9]+\)/', 'int', $def);

		/* make sure there is always a space before mysql words */
		$def = preg_replace('/(\S)(unsigned|not null|binary|zerofill|auto_increment|default)/', '$1 $2', $def);

		/* treat 0.000.. same as 0 */
		$def = preg_replace('/([0-9])*\.0+/', '$1', $def);

		/* treat unsigned zerofill same as zerofill */
		$def = str_ireplace('unsigned zerofill', 'zerofill', $def);

		/* ignore zero-padding for date data types */
		$def = preg_replace("/date\s*default\s*'([0-9]{4})-0?([1-9])-0?([1-9])'/", "date default '$1-$2-$3'", $def);

		return trim($def);
	}

	/**
	 *  @brief creates/fixes given field according to given schema
	 *  @return integer: 0 = error, 1 = field updated, 2 = field created
	 */
	function fix_field($fix_table, $fix_field, $schema, &$qry) {
		if(!isset($schema[$fix_table][$fix_field])) return 0;

		$def = $schema[$fix_table][$fix_field];
		$field_added = $field_updated = false;
		$eo['silentErrors'] = true;

		// field exists?
		$res = sql("show columns from `{$fix_table}` like '{$fix_field}'", $eo);
		if($row = db_fetch_assoc($res)) {
			// modify field
			$qry = "alter table `{$fix_table}` modify `{$fix_field}` {$def['appgini']}";
			sql($qry, $eo);

			// remove unique from db if necessary
			if($row['Key'] == 'UNI' && !stripos($def['appgini'], ' unique')) {
				// retrieve unique index name
				$res_unique = sql("show index from `{$fix_table}` where Column_name='{$fix_field}' and Non_unique=0", $eo);
				if($row_unique = db_fetch_assoc($res_unique)) {
					$qry_unique = "drop index `{$row_unique['Key_name']}` on `{$fix_table}`";
					sql($qry_unique, $eo);
					$qry .= ";\n{$qry_unique}";
				}
			}

			return 1;
		}

		// missing field is defined as PK and table has another PK field?
		$current_pk = getPKFieldName($fix_table);
		if(stripos($def['appgini'], 'primary key') !== false && $current_pk !== false) {
			// if current PK is not another AppGini-defined field, then rename it.
			if(!isset($schema[$fix_table][$current_pk])) {
				// no need to include 'primary key' in definition since it's already a PK field
				$redef = str_ireplace(' primary key', '', $def['appgini']);
				$qry = "alter table `{$fix_table}` change `{$current_pk}` `{$fix_field}` {$redef}";
				sql($qry, $eo);
				return 1;
			}

			// current PK field is another AppGini-defined field
			// this happens if table had a PK field in AppGini then it was unset as PK
			// and another field was created and set as PK
			// in that case, drop PK index from current PK
			// and also remove auto_increment from it if defined
			// then proceed to creating the missing PK field
			$pk_def = str_ireplace(' auto_increment', '', $schema[$fix_table][$current_pk]);
			sql("alter table `{$fix_table}` modify `{$current_pk}` {$pk_def}", $eo);
		}

		// create field
		$qry = "alter table `{$fix_table}` add column `{$fix_field}` {$def['appgini']}";
		sql($qry, $eo);
		return 2;
	}

	/* process requested fixes */
	$fix_table = (isset($_GET['t']) ? $_GET['t'] : false);
	$fix_field = (isset($_GET['f']) ? $_GET['f'] : false);
	$fix_all = (isset($_GET['all']) ? true : false);

	if($fix_field && $fix_table) $fix_status = fix_field($fix_table, $fix_field, $schema, $qry);

	/* retrieve actual db schema */
	foreach($table_captions as $tn => $tc) {
		$eo['silentErrors'] = true;
		$res = sql("show columns from `{$tn}`", $eo);
		if($res) {
			while($row = db_fetch_assoc($res)) {
				if(!isset($schema[$tn][$row['Field']]['appgini'])) continue;
				$field_description = strtoupper(str_replace(' ', '', $row['Type']));
				$field_description = str_ireplace('unsigned', ' unsigned', $field_description);
				$field_description = str_ireplace('zerofill', ' zerofill', $field_description);
				$field_description = str_ireplace('binary', ' binary', $field_description);
				$field_description .= ($row['Null'] == 'NO' ? ' not null' : '');
				$field_description .= ($row['Key'] == 'PRI' ? ' primary key' : '');
				$field_description .= ($row['Key'] == 'UNI' ? ' unique' : '');
				$field_description .= ($row['Default'] != '' ? " default '" . makeSafe($row['Default']) . "'" : '');
				$field_description .= ($row['Extra'] == 'auto_increment' ? ' auto_increment' : '');

				$schema[$tn][$row['Field']]['db'] = '';
				if(isset($schema[$tn][$row['Field']])) {
					$schema[$tn][$row['Field']]['db'] = $field_description;
				}
			}
		}
	}

	/* handle fix_all request */
	if($fix_all) {
		foreach($schema as $tn => $fields) {
			foreach($fields as $fn => $fd) {
				if(prepare_def($fd['appgini']) == prepare_def($fd['db'])) continue;
				fix_field($tn, $fn, $schema, $qry);
			}
		}

		redirect('admin/pageRebuildFields.php');
		exit;
	}
?>

<?php if($fix_status == 1 || $fix_status == 2) { ?>
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<i class="glyphicon glyphicon-info-sign"></i>
		<?php 
			$originalValues = array('<ACTION>', '<FIELD>', '<TABLE>', '<QUERY>');
			$action = ($fix_status == 2 ? 'create' : 'update');
			$replaceValues = array($action, $fix_field, $fix_table, $qry);
			echo str_replace($originalValues, $replaceValues, $Translation['create or update table']);
		?>
	</div>
<?php } ?>

<div class="page-header"><h1>
	<?php echo $Translation['view or rebuild fields'] ; ?>
	<button type="button" class="btn btn-default" id="show_deviations_only"><i class="glyphicon glyphicon-eye-close"></i> <?php echo $Translation['show deviations only'] ; ?></button>
	<button type="button" class="btn btn-default hidden" id="show_all_fields"><i class="glyphicon glyphicon-eye-open"></i> <?php echo $Translation['show all fields'] ; ?></button>
</h1></div>

<p class="lead"><?php echo $Translation['compare tables page'] ; ?></p>

<div class="alert summary"></div>
<table class="table table-responsive table-hover table-striped">
	<thead><tr>
		<th></th>
		<th><?php echo $Translation['field'] ; ?></th>
		<th><?php echo $Translation['AppGini definition'] ; ?></th>
		<th><?php echo $Translation['database definition'] ; ?></th>
		<th id="fix_all"></th>
	</tr></thead>

	<tbody>
	<?php foreach($schema as $tn => $fields) { ?>
		<tr class="text-info"><td colspan="5"><h4 data-placement="left" data-toggle="tooltip" title="<?php echo str_replace ( "<TABLENAME>" , $tn , $Translation['table name title']) ; ?>"><i class="glyphicon glyphicon-th-list"></i> <?php echo $table_captions[$tn]; ?></h4></td></tr>
		<?php foreach($fields as $fn => $fd) { ?>
			<?php $diff = ((prepare_def($fd['appgini']) == prepare_def($fd['db'])) ? false : true); ?>
			<?php $no_db = ($fd['db'] ? false : true); ?>
			<tr class="<?php echo ($diff ? 'warning' : 'field_ok'); ?>">
				<td><i class="glyphicon glyphicon-<?php echo ($diff ? 'remove text-danger' : 'ok text-success'); ?>"></i></td>
				<td><?php echo $fn; ?></td>
				<td class="<?php echo ($diff ? 'bold text-success' : ''); ?>"><?php echo $fd['appgini']; ?></td>
				<td class="<?php echo ($diff ? 'bold text-danger' : ''); ?>"><?php echo thisOr($fd['db'], $Translation['does not exist']); ?></td>
				<td>
					<?php if($diff && $no_db) { ?>
						<a href="pageRebuildFields.php?t=<?php echo $tn; ?>&f=<?php echo $fn; ?>" class="btn btn-success btn-xs btn_create" data-toggle="tooltip" data-placement="top" title="<?php echo $Translation['create field'] ; ?>"><i class="glyphicon glyphicon-plus"></i> <?php echo $Translation['create it'] ; ?></a>
					<?php }elseif($diff) { ?>
						<a href="pageRebuildFields.php?t=<?php echo $tn; ?>&f=<?php echo $fn; ?>" class="btn btn-warning btn-xs btn_update" data-toggle="tooltip" title="<?php echo $Translation['fix field'] ; ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['fix it'] ; ?></a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	<?php } ?>
	</tbody>
</table>
<div class="alert summary"></div>

<style>
	.bold{ font-weight: bold; }
	[data-toggle="tooltip"]{ display: block !important; }
</style>

<script>
	$j(function() {
		$j('[data-toggle="tooltip"]').tooltip();

		$j('#show_deviations_only').click(function() {
			$j(this).addClass('hidden');
			$j('#show_all_fields').removeClass('hidden');
			$j('.field_ok').hide();
		});

		$j('#show_all_fields').click(function() {
			$j(this).addClass('hidden');
			$j('#show_deviations_only').removeClass('hidden');
			$j('.field_ok').show();
		});

		$j('.btn_update, #fix_all').click(function() {
			return confirm("<?php echo $Translation['field update warning'] ; ?>");
		});

		var count_updates = $j('.btn_update').length;
		var count_creates = $j('.btn_create').length;
		if(!count_creates && !count_updates) {
			$j('.summary').addClass('alert-success').html("<?php echo $Translation['no deviations found'] ; ?>");
		}else{
			var fieldsCount = "<?php echo $Translation['error fields']; ?>";
			fieldsCount = fieldsCount.replace(/<CREATENUM>/, count_creates ).replace(/<UPDATENUM>/, count_updates);


			$j('.summary')
				.addClass('alert-warning')
				.html(
					fieldsCount + 
					'<br><br>' + 
					'<a href="pageBackupRestore.php" class="alert-link">' +
						'<b><?php echo addslashes($Translation['backup before fix']); ?></b>' +
					'</a>'
				);

			$j('<a href="pageRebuildFields.php?all=1" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-cog"></i> <?php echo addslashes($Translation['fix all']); ?></a>').appendTo('#fix_all');
		}
	});
</script>

<?php
	include("{$currDir}/incFooter.php");
?>
