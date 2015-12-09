AlterInvoicesTable: alter table `invoices` add `po_number` varchar(20) null after `hospital_id`, add `special_notes` varchar(5000) null after `po_number`
AlterInvoicesTable: alter table `invoices` drop `next_step`
AlterInvoicesTable: alter table `invoices` drop `last_step`
AlterProcedureInformationTable: ALTER TABLE procedure_information CHANGE collection_start_time collection_start_time TIME DEFAULT NULL, CHANGE wash_time wash_time VARCHAR(8) DEFAULT NULL
AlterProcedureInformationTable: alter table `procedure_information` add `total_time` time not null after `operation_end_time`
AlterStaffInformationTable: ALTER TABLE staff_information CHANGE secondary_autotransfusionist_id secondary_autotransfusionist_id INT UNSIGNED DEFAULT NULL
AlterLabInformationTable: ALTER TABLE lab_information CHANGE pre_op_hematocrit pre_op_hematocrit NUMERIC(8, 2) DEFAULT NULL, CHANGE date_taken date_taken DATE DEFAULT NULL
AlterEqipmentTable: ALTER TABLE equipment CHANGE device_name device_name VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE manufacturer manufacturer VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE serial_number serial_number VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE self_test_passed self_test_passed TINYINT(1) DEFAULT NULL
AlterTransfusionSupplies: alter table `transfusion_supplies` add `supplies_total` decimal(10, 2) not null
AlterHospitalsTable: alter table `hospitals` add `anticoagulent_volume` int not null after `state`
AlterHospitalsTable: alter table `hospitals` drop `street_address`
AlterHospitalsTable: alter table `hospitals` drop `street_address_2`
AlterHospitalsTable: alter table `hospitals` drop `zip_code`
AlterUserTable: alter table `users` add `admin` tinyint(1) not null
AlterStaffInformation: ALTER TABLE staff_information CHANGE anesthesiologist_id anesthesiologist_id INT UNSIGNED DEFAULT NULL
AlterHosptials: alter table `hospitals` drop `city`
