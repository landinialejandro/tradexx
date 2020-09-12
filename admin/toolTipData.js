var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// Customers table
Customers_addTip=["",spacer+"This option allows all members of the group to add records to the 'CUSTOMERS' table. A member who adds a record to the table becomes the 'owner' of that record."];

Customers_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CUSTOMERS' table."];
Customers_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CUSTOMERS' table."];
Customers_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CUSTOMERS' table."];
Customers_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CUSTOMERS' table."];

Customers_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CUSTOMERS' table."];
Customers_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CUSTOMERS' table."];
Customers_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CUSTOMERS' table."];
Customers_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CUSTOMERS' table, regardless of their owner."];

Customers_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CUSTOMERS' table."];
Customers_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CUSTOMERS' table."];
Customers_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CUSTOMERS' table."];
Customers_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CUSTOMERS' table."];

// Retention table
Retention_addTip=["",spacer+"This option allows all members of the group to add records to the 'RETENTION' table. A member who adds a record to the table becomes the 'owner' of that record."];

Retention_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'RETENTION' table."];
Retention_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'RETENTION' table."];
Retention_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'RETENTION' table."];
Retention_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'RETENTION' table."];

Retention_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'RETENTION' table."];
Retention_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'RETENTION' table."];
Retention_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'RETENTION' table."];
Retention_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'RETENTION' table, regardless of their owner."];

Retention_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'RETENTION' table."];
Retention_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'RETENTION' table."];
Retention_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'RETENTION' table."];
Retention_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'RETENTION' table."];

// Alert table
Alert_addTip=["",spacer+"This option allows all members of the group to add records to the 'CUSTOMER ALERT' table. A member who adds a record to the table becomes the 'owner' of that record."];

Alert_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CUSTOMER ALERT' table."];
Alert_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CUSTOMER ALERT' table."];
Alert_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CUSTOMER ALERT' table."];
Alert_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CUSTOMER ALERT' table."];

Alert_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CUSTOMER ALERT' table."];
Alert_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CUSTOMER ALERT' table."];
Alert_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CUSTOMER ALERT' table."];
Alert_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CUSTOMER ALERT' table, regardless of their owner."];

Alert_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CUSTOMER ALERT' table."];
Alert_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CUSTOMER ALERT' table."];
Alert_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CUSTOMER ALERT' table."];
Alert_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CUSTOMER ALERT' table."];

// CustomerClass table
CustomerClass_addTip=["",spacer+"This option allows all members of the group to add records to the 'CUSTOMER TYPE' table. A member who adds a record to the table becomes the 'owner' of that record."];

CustomerClass_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CUSTOMER TYPE' table."];
CustomerClass_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CUSTOMER TYPE' table."];
CustomerClass_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CUSTOMER TYPE' table."];
CustomerClass_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CUSTOMER TYPE' table."];

CustomerClass_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CUSTOMER TYPE' table."];
CustomerClass_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CUSTOMER TYPE' table."];
CustomerClass_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CUSTOMER TYPE' table."];
CustomerClass_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CUSTOMER TYPE' table, regardless of their owner."];

CustomerClass_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CUSTOMER TYPE' table."];
CustomerClass_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CUSTOMER TYPE' table."];
CustomerClass_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CUSTOMER TYPE' table."];
CustomerClass_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CUSTOMER TYPE' table."];

// Staff table
Staff_addTip=["",spacer+"This option allows all members of the group to add records to the 'STAFF' table. A member who adds a record to the table becomes the 'owner' of that record."];

Staff_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'STAFF' table."];
Staff_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'STAFF' table."];
Staff_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'STAFF' table."];
Staff_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'STAFF' table."];

Staff_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'STAFF' table."];
Staff_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'STAFF' table."];
Staff_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'STAFF' table."];
Staff_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'STAFF' table, regardless of their owner."];

Staff_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'STAFF' table."];
Staff_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'STAFF' table."];
Staff_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'STAFF' table."];
Staff_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'STAFF' table."];

// Country table
Country_addTip=["",spacer+"This option allows all members of the group to add records to the 'Country' table. A member who adds a record to the table becomes the 'owner' of that record."];

Country_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Country' table."];
Country_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Country' table."];
Country_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Country' table."];
Country_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Country' table."];

Country_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Country' table."];
Country_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Country' table."];
Country_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Country' table."];
Country_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Country' table, regardless of their owner."];

Country_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Country' table."];
Country_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Country' table."];
Country_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Country' table."];
Country_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Country' table."];

// Province table
Province_addTip=["",spacer+"This option allows all members of the group to add records to the 'Province' table. A member who adds a record to the table becomes the 'owner' of that record."];

Province_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Province' table."];
Province_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Province' table."];
Province_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Province' table."];
Province_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Province' table."];

Province_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Province' table."];
Province_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Province' table."];
Province_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Province' table."];
Province_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Province' table, regardless of their owner."];

Province_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Province' table."];
Province_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Province' table."];
Province_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Province' table."];
Province_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Province' table."];

// City table
City_addTip=["",spacer+"This option allows all members of the group to add records to the 'City' table. A member who adds a record to the table becomes the 'owner' of that record."];

City_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'City' table."];
City_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'City' table."];
City_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'City' table."];
City_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'City' table."];

City_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'City' table."];
City_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'City' table."];
City_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'City' table."];
City_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'City' table, regardless of their owner."];

City_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'City' table."];
City_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'City' table."];
City_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'City' table."];
City_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'City' table."];

// Warehouse table
Warehouse_addTip=["",spacer+"This option allows all members of the group to add records to the 'WAREHOUSE' table. A member who adds a record to the table becomes the 'owner' of that record."];

Warehouse_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'WAREHOUSE' table."];
Warehouse_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'WAREHOUSE' table."];
Warehouse_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'WAREHOUSE' table."];
Warehouse_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'WAREHOUSE' table."];

Warehouse_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'WAREHOUSE' table."];
Warehouse_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'WAREHOUSE' table."];
Warehouse_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'WAREHOUSE' table."];
Warehouse_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'WAREHOUSE' table, regardless of their owner."];

Warehouse_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'WAREHOUSE' table."];
Warehouse_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'WAREHOUSE' table."];
Warehouse_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'WAREHOUSE' table."];
Warehouse_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'WAREHOUSE' table."];

// Tracking table
Tracking_addTip=["",spacer+"This option allows all members of the group to add records to the 'TRACKING' table. A member who adds a record to the table becomes the 'owner' of that record."];

Tracking_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'TRACKING' table."];
Tracking_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'TRACKING' table."];
Tracking_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'TRACKING' table."];
Tracking_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'TRACKING' table."];

Tracking_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'TRACKING' table."];
Tracking_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'TRACKING' table."];
Tracking_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'TRACKING' table."];
Tracking_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'TRACKING' table, regardless of their owner."];

Tracking_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'TRACKING' table."];
Tracking_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'TRACKING' table."];
Tracking_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'TRACKING' table."];
Tracking_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'TRACKING' table."];

// Status table
Status_addTip=["",spacer+"This option allows all members of the group to add records to the 'STATUS' table. A member who adds a record to the table becomes the 'owner' of that record."];

Status_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'STATUS' table."];
Status_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'STATUS' table."];
Status_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'STATUS' table."];
Status_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'STATUS' table."];

Status_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'STATUS' table."];
Status_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'STATUS' table."];
Status_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'STATUS' table."];
Status_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'STATUS' table, regardless of their owner."];

Status_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'STATUS' table."];
Status_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'STATUS' table."];
Status_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'STATUS' table."];
Status_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'STATUS' table."];

// Invoice table
Invoice_addTip=["",spacer+"This option allows all members of the group to add records to the 'INVOICE' table. A member who adds a record to the table becomes the 'owner' of that record."];

Invoice_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'INVOICE' table."];
Invoice_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'INVOICE' table."];
Invoice_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'INVOICE' table."];
Invoice_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'INVOICE' table."];

Invoice_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'INVOICE' table."];
Invoice_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'INVOICE' table."];
Invoice_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'INVOICE' table."];
Invoice_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'INVOICE' table, regardless of their owner."];

Invoice_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'INVOICE' table."];
Invoice_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'INVOICE' table."];
Invoice_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'INVOICE' table."];
Invoice_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'INVOICE' table."];

// InvoiceDetails table
InvoiceDetails_addTip=["",spacer+"This option allows all members of the group to add records to the 'Datails' table. A member who adds a record to the table becomes the 'owner' of that record."];

InvoiceDetails_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Datails' table."];
InvoiceDetails_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Datails' table."];
InvoiceDetails_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Datails' table."];
InvoiceDetails_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Datails' table."];

InvoiceDetails_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Datails' table."];
InvoiceDetails_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Datails' table."];
InvoiceDetails_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Datails' table."];
InvoiceDetails_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Datails' table, regardless of their owner."];

InvoiceDetails_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Datails' table."];
InvoiceDetails_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Datails' table."];
InvoiceDetails_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Datails' table."];
InvoiceDetails_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Datails' table."];

// Products table
Products_addTip=["",spacer+"This option allows all members of the group to add records to the 'PRODUCTS' table. A member who adds a record to the table becomes the 'owner' of that record."];

Products_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'PRODUCTS' table."];
Products_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'PRODUCTS' table."];
Products_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'PRODUCTS' table."];
Products_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'PRODUCTS' table."];

Products_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'PRODUCTS' table."];
Products_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'PRODUCTS' table."];
Products_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'PRODUCTS' table."];
Products_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'PRODUCTS' table, regardless of their owner."];

Products_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'PRODUCTS' table."];
Products_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'PRODUCTS' table."];
Products_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'PRODUCTS' table."];
Products_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'PRODUCTS' table."];

// WHJournal table
WHJournal_addTip=["",spacer+"This option allows all members of the group to add records to the 'WH JOURNAL' table. A member who adds a record to the table becomes the 'owner' of that record."];

WHJournal_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'WH JOURNAL' table."];
WHJournal_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'WH JOURNAL' table."];
WHJournal_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'WH JOURNAL' table."];
WHJournal_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'WH JOURNAL' table."];

WHJournal_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'WH JOURNAL' table."];
WHJournal_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'WH JOURNAL' table."];
WHJournal_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'WH JOURNAL' table."];
WHJournal_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'WH JOURNAL' table, regardless of their owner."];

WHJournal_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'WH JOURNAL' table."];
WHJournal_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'WH JOURNAL' table."];
WHJournal_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'WH JOURNAL' table."];
WHJournal_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'WH JOURNAL' table."];

// CRM table
CRM_addTip=["",spacer+"This option allows all members of the group to add records to the 'CRM' table. A member who adds a record to the table becomes the 'owner' of that record."];

CRM_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CRM' table."];
CRM_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CRM' table."];
CRM_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CRM' table."];
CRM_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CRM' table."];

CRM_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CRM' table."];
CRM_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CRM' table."];
CRM_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CRM' table."];
CRM_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CRM' table, regardless of their owner."];

CRM_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CRM' table."];
CRM_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CRM' table."];
CRM_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CRM' table."];
CRM_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CRM' table."];

// Payroll table
Payroll_addTip=["",spacer+"This option allows all members of the group to add records to the 'PAYROLL' table. A member who adds a record to the table becomes the 'owner' of that record."];

Payroll_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'PAYROLL' table."];
Payroll_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'PAYROLL' table."];
Payroll_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'PAYROLL' table."];
Payroll_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'PAYROLL' table."];

Payroll_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'PAYROLL' table."];
Payroll_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'PAYROLL' table."];
Payroll_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'PAYROLL' table."];
Payroll_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'PAYROLL' table, regardless of their owner."];

Payroll_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'PAYROLL' table."];
Payroll_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'PAYROLL' table."];
Payroll_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'PAYROLL' table."];
Payroll_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'PAYROLL' table."];

// Brand table
Brand_addTip=["",spacer+"This option allows all members of the group to add records to the 'Brand' table. A member who adds a record to the table becomes the 'owner' of that record."];

Brand_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Brand' table."];
Brand_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Brand' table."];
Brand_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Brand' table."];
Brand_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Brand' table."];

Brand_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Brand' table."];
Brand_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Brand' table."];
Brand_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Brand' table."];
Brand_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Brand' table, regardless of their owner."];

Brand_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Brand' table."];
Brand_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Brand' table."];
Brand_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Brand' table."];
Brand_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Brand' table."];

// Model table
Model_addTip=["",spacer+"This option allows all members of the group to add records to the 'Model' table. A member who adds a record to the table becomes the 'owner' of that record."];

Model_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Model' table."];
Model_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Model' table."];
Model_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Model' table."];
Model_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Model' table."];

Model_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Model' table."];
Model_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Model' table."];
Model_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Model' table."];
Model_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Model' table, regardless of their owner."];

Model_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Model' table."];
Model_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Model' table."];
Model_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Model' table."];
Model_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Model' table."];

// System table
System_addTip=["",spacer+"This option allows all members of the group to add records to the 'System' table. A member who adds a record to the table becomes the 'owner' of that record."];

System_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'System' table."];
System_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'System' table."];
System_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'System' table."];
System_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'System' table."];

System_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'System' table."];
System_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'System' table."];
System_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'System' table."];
System_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'System' table, regardless of their owner."];

System_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'System' table."];
System_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'System' table."];
System_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'System' table."];
System_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'System' table."];

// Part table
Part_addTip=["",spacer+"This option allows all members of the group to add records to the 'Part' table. A member who adds a record to the table becomes the 'owner' of that record."];

Part_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Part' table."];
Part_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Part' table."];
Part_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Part' table."];
Part_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Part' table."];

Part_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Part' table."];
Part_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Part' table."];
Part_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Part' table."];
Part_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Part' table, regardless of their owner."];

Part_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Part' table."];
Part_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Part' table."];
Part_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Part' table."];
Part_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Part' table."];

// DatabaseAUTO table
DatabaseAUTO_addTip=["",spacer+"This option allows all members of the group to add records to the 'CAR DATABASE' table. A member who adds a record to the table becomes the 'owner' of that record."];

DatabaseAUTO_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CAR DATABASE' table."];
DatabaseAUTO_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CAR DATABASE' table."];
DatabaseAUTO_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CAR DATABASE' table."];
DatabaseAUTO_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CAR DATABASE' table."];

DatabaseAUTO_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CAR DATABASE' table."];
DatabaseAUTO_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CAR DATABASE' table."];
DatabaseAUTO_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CAR DATABASE' table."];
DatabaseAUTO_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CAR DATABASE' table, regardless of their owner."];

DatabaseAUTO_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CAR DATABASE' table."];
DatabaseAUTO_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CAR DATABASE' table."];
DatabaseAUTO_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CAR DATABASE' table."];
DatabaseAUTO_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CAR DATABASE' table."];

// GeneralDB table
GeneralDB_addTip=["",spacer+"This option allows all members of the group to add records to the 'GENERAL DATABASE' table. A member who adds a record to the table becomes the 'owner' of that record."];

GeneralDB_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'GENERAL DATABASE' table."];
GeneralDB_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'GENERAL DATABASE' table."];
GeneralDB_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'GENERAL DATABASE' table."];
GeneralDB_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'GENERAL DATABASE' table."];

GeneralDB_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'GENERAL DATABASE' table."];
GeneralDB_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'GENERAL DATABASE' table."];
GeneralDB_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'GENERAL DATABASE' table."];
GeneralDB_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'GENERAL DATABASE' table, regardless of their owner."];

GeneralDB_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'GENERAL DATABASE' table."];
GeneralDB_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'GENERAL DATABASE' table."];
GeneralDB_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'GENERAL DATABASE' table."];
GeneralDB_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'GENERAL DATABASE' table."];

// CustomerAuto table
CustomerAuto_addTip=["",spacer+"This option allows all members of the group to add records to the 'CUSTOMER'S VEHICLES' table. A member who adds a record to the table becomes the 'owner' of that record."];

CustomerAuto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CUSTOMER'S VEHICLES' table."];

CustomerAuto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CUSTOMER'S VEHICLES' table, regardless of their owner."];

CustomerAuto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CUSTOMER'S VEHICLES' table."];
CustomerAuto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CUSTOMER'S VEHICLES' table."];

// Compras table
Compras_addTip=["",spacer+"This option allows all members of the group to add records to the 'PURCHASE ORDERS' table. A member who adds a record to the table becomes the 'owner' of that record."];

Compras_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'PURCHASE ORDERS' table."];
Compras_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'PURCHASE ORDERS' table."];
Compras_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'PURCHASE ORDERS' table."];
Compras_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'PURCHASE ORDERS' table."];

Compras_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'PURCHASE ORDERS' table."];
Compras_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'PURCHASE ORDERS' table."];
Compras_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'PURCHASE ORDERS' table."];
Compras_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'PURCHASE ORDERS' table, regardless of their owner."];

Compras_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'PURCHASE ORDERS' table."];
Compras_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'PURCHASE ORDERS' table."];
Compras_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'PURCHASE ORDERS' table."];
Compras_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'PURCHASE ORDERS' table."];

// TrackingCenter table
TrackingCenter_addTip=["",spacer+"This option allows all members of the group to add records to the 'TRACKING CENTER' table. A member who adds a record to the table becomes the 'owner' of that record."];

TrackingCenter_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'TRACKING CENTER' table."];
TrackingCenter_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'TRACKING CENTER' table."];
TrackingCenter_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'TRACKING CENTER' table."];
TrackingCenter_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'TRACKING CENTER' table."];

TrackingCenter_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'TRACKING CENTER' table."];
TrackingCenter_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'TRACKING CENTER' table."];
TrackingCenter_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'TRACKING CENTER' table."];
TrackingCenter_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'TRACKING CENTER' table, regardless of their owner."];

TrackingCenter_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'TRACKING CENTER' table."];
TrackingCenter_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'TRACKING CENTER' table."];
TrackingCenter_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'TRACKING CENTER' table."];
TrackingCenter_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'TRACKING CENTER' table."];

// Claim table
Claim_addTip=["",spacer+"This option allows all members of the group to add records to the 'CLAIM' table. A member who adds a record to the table becomes the 'owner' of that record."];

Claim_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CLAIM' table."];
Claim_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CLAIM' table."];
Claim_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CLAIM' table."];
Claim_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CLAIM' table."];

Claim_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CLAIM' table."];
Claim_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CLAIM' table."];
Claim_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CLAIM' table."];
Claim_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CLAIM' table, regardless of their owner."];

Claim_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CLAIM' table."];
Claim_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CLAIM' table."];
Claim_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CLAIM' table."];
Claim_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CLAIM' table."];

// Activities table
Activities_addTip=["",spacer+"This option allows all members of the group to add records to the 'ACTIVITIES' table. A member who adds a record to the table becomes the 'owner' of that record."];

Activities_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'ACTIVITIES' table."];
Activities_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'ACTIVITIES' table."];
Activities_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'ACTIVITIES' table."];
Activities_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'ACTIVITIES' table."];

Activities_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'ACTIVITIES' table."];
Activities_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'ACTIVITIES' table."];
Activities_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'ACTIVITIES' table."];
Activities_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'ACTIVITIES' table, regardless of their owner."];

Activities_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'ACTIVITIES' table."];
Activities_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'ACTIVITIES' table."];
Activities_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'ACTIVITIES' table."];
Activities_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'ACTIVITIES' table."];

// Return table
Return_addTip=["",spacer+"This option allows all members of the group to add records to the 'RETURN' table. A member who adds a record to the table becomes the 'owner' of that record."];

Return_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'RETURN' table."];
Return_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'RETURN' table."];
Return_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'RETURN' table."];
Return_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'RETURN' table."];

Return_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'RETURN' table."];
Return_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'RETURN' table."];
Return_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'RETURN' table."];
Return_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'RETURN' table, regardless of their owner."];

Return_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'RETURN' table."];
Return_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'RETURN' table."];
Return_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'RETURN' table."];
Return_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'RETURN' table."];

// Department table
Department_addTip=["",spacer+"This option allows all members of the group to add records to the 'Department' table. A member who adds a record to the table becomes the 'owner' of that record."];

Department_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Department' table."];
Department_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Department' table."];
Department_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Department' table."];
Department_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Department' table."];

Department_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Department' table."];
Department_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Department' table."];
Department_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Department' table."];
Department_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Department' table, regardless of their owner."];

Department_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Department' table."];
Department_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Department' table."];
Department_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Department' table."];
Department_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Department' table."];

// Position table
Position_addTip=["",spacer+"This option allows all members of the group to add records to the 'Position' table. A member who adds a record to the table becomes the 'owner' of that record."];

Position_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Position' table."];
Position_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Position' table."];
Position_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Position' table."];
Position_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Position' table."];

Position_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Position' table."];
Position_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Position' table."];
Position_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Position' table."];
Position_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Position' table, regardless of their owner."];

Position_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Position' table."];
Position_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Position' table."];
Position_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Position' table."];
Position_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Position' table."];

// CEO table
CEO_addTip=["",spacer+"This option allows all members of the group to add records to the 'C.E.O.' table. A member who adds a record to the table becomes the 'owner' of that record."];

CEO_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'C.E.O.' table."];
CEO_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'C.E.O.' table."];
CEO_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'C.E.O.' table."];
CEO_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'C.E.O.' table."];

CEO_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'C.E.O.' table."];
CEO_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'C.E.O.' table."];
CEO_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'C.E.O.' table."];
CEO_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'C.E.O.' table, regardless of their owner."];

CEO_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'C.E.O.' table."];
CEO_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'C.E.O.' table."];
CEO_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'C.E.O.' table."];
CEO_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'C.E.O.' table."];

// Manager table
Manager_addTip=["",spacer+"This option allows all members of the group to add records to the 'MANAGER' table. A member who adds a record to the table becomes the 'owner' of that record."];

Manager_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'MANAGER' table."];
Manager_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'MANAGER' table."];
Manager_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'MANAGER' table."];
Manager_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'MANAGER' table."];

Manager_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'MANAGER' table."];
Manager_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'MANAGER' table."];
Manager_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'MANAGER' table."];
Manager_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'MANAGER' table, regardless of their owner."];

Manager_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'MANAGER' table."];
Manager_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'MANAGER' table."];
Manager_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'MANAGER' table."];
Manager_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'MANAGER' table."];

// Supervisor table
Supervisor_addTip=["",spacer+"This option allows all members of the group to add records to the 'SUPERVISOR' table. A member who adds a record to the table becomes the 'owner' of that record."];

Supervisor_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'SUPERVISOR' table."];
Supervisor_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'SUPERVISOR' table."];
Supervisor_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'SUPERVISOR' table."];
Supervisor_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'SUPERVISOR' table."];

Supervisor_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'SUPERVISOR' table."];
Supervisor_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'SUPERVISOR' table."];
Supervisor_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'SUPERVISOR' table."];
Supervisor_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'SUPERVISOR' table, regardless of their owner."];

Supervisor_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'SUPERVISOR' table."];
Supervisor_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'SUPERVISOR' table."];
Supervisor_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'SUPERVISOR' table."];
Supervisor_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'SUPERVISOR' table."];

// Losses table
Losses_addTip=["",spacer+"This option allows all members of the group to add records to the 'LOSSES' table. A member who adds a record to the table becomes the 'owner' of that record."];

Losses_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'LOSSES' table."];
Losses_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'LOSSES' table."];
Losses_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'LOSSES' table."];
Losses_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'LOSSES' table."];

Losses_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'LOSSES' table."];
Losses_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'LOSSES' table."];
Losses_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'LOSSES' table."];
Losses_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'LOSSES' table, regardless of their owner."];

Losses_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'LOSSES' table."];
Losses_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'LOSSES' table."];
Losses_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'LOSSES' table."];
Losses_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'LOSSES' table."];

// Subscriptions table
Subscriptions_addTip=["",spacer+"This option allows all members of the group to add records to the 'SUSCRIPTIONS' table. A member who adds a record to the table becomes the 'owner' of that record."];

Subscriptions_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'SUSCRIPTIONS' table."];
Subscriptions_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'SUSCRIPTIONS' table."];
Subscriptions_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'SUSCRIPTIONS' table."];
Subscriptions_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'SUSCRIPTIONS' table."];

Subscriptions_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'SUSCRIPTIONS' table."];
Subscriptions_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'SUSCRIPTIONS' table."];
Subscriptions_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'SUSCRIPTIONS' table."];
Subscriptions_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'SUSCRIPTIONS' table, regardless of their owner."];

Subscriptions_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'SUSCRIPTIONS' table."];
Subscriptions_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'SUSCRIPTIONS' table."];
Subscriptions_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'SUSCRIPTIONS' table."];
Subscriptions_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'SUSCRIPTIONS' table."];

// Accounting table
Accounting_addTip=["",spacer+"This option allows all members of the group to add records to the 'CASH FLOW' table. A member who adds a record to the table becomes the 'owner' of that record."];

Accounting_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CASH FLOW' table."];
Accounting_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CASH FLOW' table."];
Accounting_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CASH FLOW' table."];
Accounting_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CASH FLOW' table."];

Accounting_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CASH FLOW' table."];
Accounting_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CASH FLOW' table."];
Accounting_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CASH FLOW' table."];
Accounting_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CASH FLOW' table, regardless of their owner."];

Accounting_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CASH FLOW' table."];
Accounting_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CASH FLOW' table."];
Accounting_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CASH FLOW' table."];
Accounting_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CASH FLOW' table."];

// MasterAccount table
MasterAccount_addTip=["",spacer+"This option allows all members of the group to add records to the 'Master Account' table. A member who adds a record to the table becomes the 'owner' of that record."];

MasterAccount_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Master Account' table."];
MasterAccount_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Master Account' table."];
MasterAccount_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Master Account' table."];
MasterAccount_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Master Account' table."];

MasterAccount_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Master Account' table."];
MasterAccount_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Master Account' table."];
MasterAccount_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Master Account' table."];
MasterAccount_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Master Account' table, regardless of their owner."];

MasterAccount_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Master Account' table."];
MasterAccount_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Master Account' table."];
MasterAccount_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Master Account' table."];
MasterAccount_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Master Account' table."];

// Account table
Account_addTip=["",spacer+"This option allows all members of the group to add records to the 'ACCOUNT' table. A member who adds a record to the table becomes the 'owner' of that record."];

Account_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'ACCOUNT' table."];
Account_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'ACCOUNT' table."];
Account_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'ACCOUNT' table."];
Account_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'ACCOUNT' table."];

Account_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'ACCOUNT' table."];
Account_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'ACCOUNT' table."];
Account_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'ACCOUNT' table."];
Account_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'ACCOUNT' table, regardless of their owner."];

Account_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'ACCOUNT' table."];
Account_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'ACCOUNT' table."];
Account_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'ACCOUNT' table."];
Account_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'ACCOUNT' table."];

// SubAccount table
SubAccount_addTip=["",spacer+"This option allows all members of the group to add records to the 'SubAccount' table. A member who adds a record to the table becomes the 'owner' of that record."];

SubAccount_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'SubAccount' table."];
SubAccount_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'SubAccount' table."];
SubAccount_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'SubAccount' table."];
SubAccount_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'SubAccount' table."];

SubAccount_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'SubAccount' table."];
SubAccount_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'SubAccount' table."];
SubAccount_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'SubAccount' table."];
SubAccount_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'SubAccount' table, regardless of their owner."];

SubAccount_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'SubAccount' table."];
SubAccount_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'SubAccount' table."];
SubAccount_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'SubAccount' table."];
SubAccount_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'SubAccount' table."];

// Type table
Type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Type' table. A member who adds a record to the table becomes the 'owner' of that record."];

Type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Type' table."];
Type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Type' table."];
Type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Type' table."];
Type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Type' table."];

Type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Type' table."];
Type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Type' table."];
Type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Type' table."];
Type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Type' table, regardless of their owner."];

Type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Type' table."];
Type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Type' table."];
Type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Type' table."];
Type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Type' table."];

// CCJournal table
CCJournal_addTip=["",spacer+"This option allows all members of the group to add records to the 'CC JOURNAL' table. A member who adds a record to the table becomes the 'owner' of that record."];

CCJournal_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CC JOURNAL' table."];
CCJournal_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CC JOURNAL' table."];
CCJournal_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CC JOURNAL' table."];
CCJournal_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CC JOURNAL' table."];

CCJournal_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CC JOURNAL' table."];
CCJournal_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CC JOURNAL' table."];
CCJournal_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CC JOURNAL' table."];
CCJournal_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CC JOURNAL' table, regardless of their owner."];

CCJournal_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CC JOURNAL' table."];
CCJournal_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CC JOURNAL' table."];
CCJournal_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CC JOURNAL' table."];
CCJournal_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CC JOURNAL' table."];

// CC table
CC_addTip=["",spacer+"This option allows all members of the group to add records to the 'CC' table. A member who adds a record to the table becomes the 'owner' of that record."];

CC_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CC' table."];
CC_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CC' table."];
CC_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CC' table."];
CC_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CC' table."];

CC_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CC' table."];
CC_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CC' table."];
CC_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CC' table."];
CC_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CC' table, regardless of their owner."];

CC_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CC' table."];
CC_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CC' table."];
CC_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CC' table."];
CC_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CC' table."];

// Receivable table
Receivable_addTip=["",spacer+"This option allows all members of the group to add records to the 'Receivable' table. A member who adds a record to the table becomes the 'owner' of that record."];

Receivable_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Receivable' table."];
Receivable_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Receivable' table."];
Receivable_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Receivable' table."];
Receivable_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Receivable' table."];

Receivable_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Receivable' table."];
Receivable_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Receivable' table."];
Receivable_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Receivable' table."];
Receivable_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Receivable' table, regardless of their owner."];

Receivable_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Receivable' table."];
Receivable_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Receivable' table."];
Receivable_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Receivable' table."];
Receivable_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Receivable' table."];

// AccountPlan table
AccountPlan_addTip=["",spacer+"This option allows all members of the group to add records to the 'AccountPlan' table. A member who adds a record to the table becomes the 'owner' of that record."];

AccountPlan_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'AccountPlan' table."];
AccountPlan_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'AccountPlan' table."];
AccountPlan_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'AccountPlan' table."];
AccountPlan_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'AccountPlan' table."];

AccountPlan_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'AccountPlan' table."];
AccountPlan_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'AccountPlan' table."];
AccountPlan_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'AccountPlan' table."];
AccountPlan_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'AccountPlan' table, regardless of their owner."];

AccountPlan_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'AccountPlan' table."];
AccountPlan_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'AccountPlan' table."];
AccountPlan_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'AccountPlan' table."];
AccountPlan_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'AccountPlan' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
