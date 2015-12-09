CreateInvoiceFilesTable: create table `invoice_files` (`id` int unsigned not null auto_increment primary key, `filename` varchar(150) not null, `invoice_id` int unsigned not null, `created_at` timestamp default 0 not null, `updated_at` timestamp default 0 not null) default character set utf8 collate utf8_unicode_ci
CreateInvoiceFilesTable: alter table `invoice_files` add constraint invoice_files_invoice_id_foreign foreign key (`invoice_id`) references `invoices` (`id`) on delete cascade
AlterInvoicesTable: alter table `invoices` add `po_number` varchar(20) null after `hospital_id`, add `special_notes` varchar(5000) null after `po_number`
AlterInvoicesTable: alter table `invoices` drop `next_step`
AlterInvoicesTable: alter table `invoices` drop `last_step`
AlterProcedureInformationTable: ALTER TABLE procedure_information CHANGE wash_time wash_time VARCHAR(8) DEFAULT NULL
AlterProcedureInformationTable: alter table `procedure_information` add `total_time` time not null after `operation_end_time`
AlterTransfusionSupplies: alter table `transfusion_supplies` add `supplies_total` decimal(10, 2) not null
AlterHospitalsTable: alter table `hospitals` add `anticoagulent_volume` int not null after `state`
AlterHospitalsTable: alter table `hospitals` drop `street_address`
AlterHospitalsTable: alter table `hospitals` drop `street_address_2`
AlterHospitalsTable: alter table `hospitals` drop `zip_code`
AlterUserTable: alter table `users` add `admin` tinyint(1) not null
