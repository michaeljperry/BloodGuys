' To Creat on Go Daddy: Select Routines, Add Routine, copy everything from Begin to End. Set it to Contains SQL. Execute.
USE `bloodguys`;
DROP procedure IF EXISTS `GetCompletedInvoices`;

DELIMITER $$
USE `bloodguys`$$
CREATE PROCEDURE `GetCompletedInvoices` ()
BEGIN
Set @row_number:=0;
Set @invoice_id := 0;

select @row_number:= CASE WHEN @invoice_id = invoices.id THEN ( @row_number + 1 ) ELSE 1 END AS 'row_number', @invoice_id:=invoices.id as 'InvoiceId', hospitals.name as 'Hospital', hospitals.state as 'State', invoices.procedure_date, pi.patient_number, pi.medical_record_number, 
Case when surgeons.first_name = ' ' then surgeons.last_name else Concat(surgeons.last_name, ', ', surgeons.first_name) end as 'Surgeon',
`proc_info`.`procedure`,
proc_totals.ebl_or, 
proc_totals.rbc_returned_or,
proc_totals.ebl_po, 
proc_totals.rbc_returned_po,
0 as 'Predntd_Avail',
0 as 'Predntd_Used',
Concat(hospitals.anticoagulent_volume, ' UNITS/ACDA') as 'AntiCoag',
services.basic_service_total + services.modified_service_total + supplies.supplies_total + services.additional_operator_hours_total + services.platelate_gel_service_total as 'Charge',
Case when autotransfusionist.first_name = ' ' then autotransfusionist.last_name else Concat(autotransfusionist.last_name, ', ', autotransfusionist.first_name) end as 'AutoTransfusionist1',
Case when autotransfusionist2.first_name = ' ' then autotransfusionist2.last_name else Concat(autotransfusionist2.last_name, ', ', autotransfusionist2.first_name) end as 'AutoTransfusionist2',
invoices.special_notes,
case when rbc_returned_or = 0 AND rbc_returned_po = 0 Then 'NO WASH' else 'NONE' end as 'ComplicationInvolved',
invoices.po_number
from invoices
inner join hospitals on hospitals.id = invoices.hospital_id
inner join patient_information pi on pi.invoice_id = invoices.id
inner join procedure_information proc_info on proc_info.invoice_id = invoices.id
inner join staff_information staff on staff.invoice_id = invoices.id
inner join procedure_totals proc_totals on proc_totals.invoice_id = invoices.id
left join professionals surgeons on staff.surgeon_id = surgeons.id 
inner join users autotransfusionist on autotransfusionist.id = staff.primary_autotransfusionist_id
left join users autotransfusionist2 on staff.secondary_autotransfusionist_id = autotransfusionist2.id 
inner join transfusion_services services on services.invoice_id = invoices.id
inner join transfusion_supplies supplies on supplies.invoice_id = invoices.id
where invoices.completed = true and invoices.billed = false
order by invoices.id;
END$$

DELIMITER ;
