-- -------------------------------------------------
-- Purpose: Drop unrecognized validation table.
--
-- Author: Justin Pfefferle
--
-- Revision: 11/18/2020 - Creation
-- -------------------------------------------------
 
USE pride_db;
DROP TABLE IF EXISTS inv_line_item_validation_result;
