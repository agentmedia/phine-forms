
--
-- Constraints der Tabelle `pc_forms_content_checkbox`
--
ALTER TABLE `pc_forms_content_checkbox`
  ADD CONSTRAINT `pc_forms_content_checkbox_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_content_fieldset`
--
ALTER TABLE `pc_forms_content_fieldset`
  ADD CONSTRAINT `pc_forms_content_fieldset_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_content_form`
--
ALTER TABLE `pc_forms_content_form`
  ADD CONSTRAINT `pc_forms_content_form_ibfk_2` FOREIGN KEY (`RedirectUrl`) REFERENCES `pc_core_page_url` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_forms_content_form_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_content_radio`
--
ALTER TABLE `pc_forms_content_radio`
  ADD CONSTRAINT `pc_forms_content_radio_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_content_select`
--
ALTER TABLE `pc_forms_content_select`
  ADD CONSTRAINT `pc_forms_content_select_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_content_submit`
--
ALTER TABLE `pc_forms_content_submit`
  ADD CONSTRAINT `pc_forms_content_submit_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_content_textarea`
--
ALTER TABLE `pc_forms_content_textarea`
  ADD CONSTRAINT `pc_forms_content_textarea_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_content_textfield`
--
ALTER TABLE `pc_forms_content_textfield`
  ADD CONSTRAINT `pc_forms_content_textfield_ibfk_1` FOREIGN KEY (`Content`) REFERENCES `pc_core_content` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_radio_option`
--
ALTER TABLE `pc_forms_radio_option`
  ADD CONSTRAINT `pc_forms_radio_option_ibfk_2` FOREIGN KEY (`Previous`) REFERENCES `pc_forms_radio_option` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_forms_radio_option_ibfk_1` FOREIGN KEY (`RadioField`) REFERENCES `pc_forms_content_radio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pc_forms_select_option`
--
ALTER TABLE `pc_forms_select_option`
  ADD CONSTRAINT `pc_forms_select_option_ibfk_1` FOREIGN KEY (`SelectField`) REFERENCES `pc_forms_content_select` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_forms_select_option_ibfk_2` FOREIGN KEY (`Previous`) REFERENCES `pc_forms_select_option` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;
