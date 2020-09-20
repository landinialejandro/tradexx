/**
 * Author:  ale
 * Created: 22/11/2018
 */
CREATE OR REPLACE VIEW SQL_view_Sales AS 
SELECT Invoice.id, Products.item, Invoice.PaymentStatus, Invoice.usrAdd, Invoice.Status
FROM InvoiceDetails 
RIGHT OUTER JOIN Invoice ON InvoiceDetails.invoice = Invoice.id 
LEFT OUTER JOIN Products ON Products.id = InvoiceDetails.product
WHERE Invoice.type = 'Invoice'
ORDER BY Invoice.id DESC 
LIMIT 10;