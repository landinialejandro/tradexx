/**
 * Author:  ale
 * Created: 22/11/2018
 */
CREATE OR REPLACE VIEW SQL_view_Sales AS 
SELECT Invoice.id, Products.item, Invoice.PaymentStatus, Invoice.usrAdd FROM { oj tradexx.InvoiceDetails InvoiceDetails RIGHT OUTER JOIN tradexx.Invoice Invoice ON InvoiceDetails.invoice = Invoice.id LEFT OUTER JOIN tradexx.Products Products ON Products.id = InvoiceDetails.product } WHERE Invoice.type = 'Invoice'