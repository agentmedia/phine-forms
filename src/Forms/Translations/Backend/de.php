<?php
use Phine\Framework\Localization\PhpTranslator;
$translator = PhpTranslator::Singleton();
$lang = 'de';
//Form Form
$translator->AddTranslation($lang, 'Forms.Form.BackendName', 'Formular');
$translator->AddTranslation($lang, 'Forms.FormForm.Title', 'Formular bearbeiten');
$translator->AddTranslation($lang, 'Forms.FormForm.Legend', 'Formular-Einstellungen');
$translator->AddTranslation($lang, 'Forms.FormForm.Description', 'Legen Sie hier die Eigenschaften des Formulars fest. Einzelne Felder können Sie in der Baumansicht der Inhaltselemente einfügen.');

$translator->AddTranslation($lang, 'Forms.FormForm.Method', 'Formularübertragung');
$translator->AddTranslation($lang, 'Forms.FormForm.Method.Post', 'POST');
$translator->AddTranslation($lang, 'Forms.FormForm.Method.Get', 'GET');
$translator->AddTranslation($lang, 'Forms.FormForm.RedirectUrl', 'Weiterleitung');

$translator->AddTranslation($lang, 'Forms.FormForm.SaveTo', 'Speichern in Tabelle');
$translator->AddTranslation($lang, 'Forms.FormForm.SaveTo.None', '- Keine Tabelle -');

$translator->AddTranslation($lang, 'Forms.FormForm.SendFrom', 'Mail von');
$translator->AddTranslation($lang, 'Forms.FormForm.SendTo', 'Mail an');
$translator->AddTranslation($lang, 'Forms.FormForm.Submit', 'Speichern');

$translator->AddTranslation($lang, 'Forms.FormForm.SendFrom.Validation.Required.Missing', 'Entweder Tabelle oder sowohl "VON"- als auch "AN"-Mailadresse angeben');
$translator->AddTranslation($lang, 'Forms.FormForm.SendTo.Validation.Required.Missing', 'Entweder Tabelle oder sowohl "VON"- als auch "AN"-Mailadresse angeben');
$translator->AddTranslation($lang, 'Forms.FormForm.SaveTo.Validation.Required.Missing', 'Entweder Tabelle oder sowohl "VON"- als auch "AN"-Mailadresse angeben');

//radio form
$translator->AddTranslation($lang, 'Forms.Radio.BackendName', 'Radio-Feld');
$translator->AddTranslation($lang, 'Forms.RadioForm.Title', 'Radio-Feld bearbeiten');
$translator->AddTranslation($lang, 'Forms.RadioForm.Legend', 'Radio-Feld-Einstellungen');
$translator->AddTranslation($lang, 'Forms.RadioForm.Description', 'Hier können Sie die Gruppe von Radio-Buttons anpassen.');
$translator->AddTranslation($lang, 'Forms.RadioForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.RadioForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.RadioForm.Value', 'Standard-Wert');
$translator->AddTranslation($lang, 'Forms.RadioForm.Required', 'Ist Pflichtfeld');
$translator->AddTranslation($lang, 'Forms.RadioForm.DisableFrontendValidation', 'HTML-Validierung ausschalten');
$translator->AddTranslation($lang, 'Forms.RadioForm.Options', 'Optionen');
$translator->AddTranslation($lang, 'Forms.RadioForm.Options.Placeholder', 'Je Zeile eine Option in der Form Wert:Anzeigetext');
$translator->AddTranslation($lang, 'Forms.RadioForm.Submit', 'Speichern');

$translator->AddTranslation($lang, 'Forms.RadioForm.Name.Validation.Required.Missing', 'Der Feldname muss angegeben werden');

//select form
$translator->AddTranslation($lang, 'Forms.Select.BackendName', 'Auswahlbox');
$translator->AddTranslation($lang, 'Forms.SelectForm.Title', 'Auswahlbox bearbeiten');
$translator->AddTranslation($lang, 'Forms.SelectForm.Description', 'Here you can edit the selection field and its options.');
$translator->AddTranslation($lang, 'Forms.SelectForm.Legend', 'Auswahlbox-Einstellungen');
$translator->AddTranslation($lang, 'Forms.SelectForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.SelectForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.SelectForm.Value', 'Standardwert');
$translator->AddTranslation($lang, 'Forms.SelectForm.Required', 'Ist Pflichtfeld');
$translator->AddTranslation($lang, 'Forms.SelectForm.DisableFrontendValidation', 'HTML-Validierung ausschalten');
$translator->AddTranslation($lang, 'Forms.SelectForm.Options', 'Optionen');
$translator->AddTranslation($lang, 'Forms.SelectForm.Options.Placeholder', 'Eine Option pro Zeile im Format Wert:Text');
$translator->AddTranslation($lang, 'Forms.SelectForm.Submit', 'Speichern');

$translator->AddTranslation($lang, 'Forms.SelectForm.Name.Validation.Required.Missing', 'Der Feldname muss angegeben werden');

//textarea form
$translator->AddTranslation($lang, 'Forms.Textarea.BackendName', 'Textbereich');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Title', 'Textbereich bearbeiten');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Description', 'Editieren Sie hier die Eigenschaften des mehrzeiligen Textfeldes.');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Legend', 'Textbereich-Einstellungen');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Value', 'Standardwert');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Label', 'Label');

$translator->AddTranslation($lang, 'Forms.TextareaForm.Pattern', 'Prüfmuster');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Pattern.Placeholder', 'Regulärer Ausdruck');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MaxLength', 'Maximale Textlänge');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MinLength', 'Minimale Textlänge');

$translator->AddTranslation($lang, 'Forms.TextareaForm.Required', 'Ist Pflichtfeld');
$translator->AddTranslation($lang, 'Forms.TextareaForm.DisableFrontendValidation', 'HTML-Validierung ausschalten');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Submit', 'Speichern');

$translator->AddTranslation($lang, 'Forms.TextareaForm.Name.Validation.Required.Missing', 'Der Feldname muss angegeben werden');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MinLength.Validation.Integer.HasNonDigits', 'Bitte eine Zahl eingeben');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MaxLength.Validation.Integer.HasNonDigits', 'Bitte eine Zahl eingeben');

//textfield form
$translator->AddTranslation($lang, 'Forms.TextfieldType.Text', 'Beliebiger Text');
$translator->AddTranslation($lang, 'Forms.TextfieldType.Tel', 'Telefonnummer');
$translator->AddTranslation($lang, 'Forms.TextfieldType.Email', 'E-Mail');
$translator->AddTranslation($lang, 'Forms.TextfieldType.Url', 'Webadresse');

$translator->AddTranslation($lang, 'Forms.Textfield.BackendName', 'Textfeld');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Title', 'Textfeld bearbeiten');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Description', 'Passen Sie hier die Eigenschaften des einzeiligen Textfeldes an.');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Legend', 'Textfeld-Einstellungen');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Value', 'Standardwert');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Required', 'Ist Pflichtfeld');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.DisableFrontendValidation', 'HTML-Validierung ausschalten');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Type', 'Typ');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Pattern', 'Prüfmuster');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Pattern.Placeholder', 'Regulärer Ausdruck');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.MaxLength', 'Maximale Textlänge');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.MinLength', 'Minimale Textlänge');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Submit', 'Speichern');


$translator->AddTranslation($lang, 'Forms.TextfieldForm.Name.Validation.Required.Missing', 'Der Feldname muss angegeben werden');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Type.Validation.Required.Missing', 'Bitte den Feldtypen auswählen');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.MinLength.Validation.Integer.HasNonDigits', 'Bitte eine Zahl eingeben');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.MaxLength.Validation.Integer.HasNonDigits', 'Bitte eine Zahl eingeben');

//checkbox form
$translator->AddTranslation($lang, 'Forms.Checkbox.BackendName', 'Kontrollkästchen');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Title', 'Kontrollkästchen bearbeiten');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Description', 'Bearbeiten Sie hier die Einstellungen der Checkbox.');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Legend', 'Kontrollkästchen-Einstellungen');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.CheckedValue', 'Übermittelter Wert');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Required', 'Pflichtfeld, Haken muss gesetzt sein');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.DisableFrontendValidation', 'HTML-Validierung ausschalten');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Checked', 'Vorab angekreuzt');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Submit', 'Speichern');

$translator->AddTranslation($lang, 'Forms.CheckboxForm.Name.Validation.Required.Missing', 'Der Feldname muss angegeben werden');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.CheckedValue.Validation.Required.Missing', 'Bei Anwahl des Kästchens übermittelten Wert festlegen');

//submit form
$translator->AddTranslation($lang, 'Forms.Submit.BackendName', 'Absendeknopf');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Title', 'Absendeknopf bearbeiten');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Description', 'Bearbeiten Sie hier die Einstellungen des Buttons zum Absenden des Formulars.');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Legend', 'Absendeknopf-Einstellungen');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Value', 'Text');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Submit', 'Speichern');

$translator->AddTranslation($lang, 'Forms.SubmitForm.Name.Validation.Required.Missing', 'Der Knopfname muss angegeben werden');

//fieldset form
$translator->AddTranslation($lang, 'Forms.Fieldset.BackendName', 'Feldgruppe');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Title', 'Feldgruppe bearbeiten');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Description', 'Passen Sie hier die Feldgruppe an Ihre Bedürfnisse an.');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.FormLegend', 'Feldgruppeneinstellungen');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Legend', 'Überschrift');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Submit', 'Speichern');

/* numberfield form */
$translator->AddTranslation($lang, 'Forms.Numberfield.BackendName', 'Zahlenfeld');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Title', 'Zahlenfeld bearbeiten');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Description', 'Ein Zahlenfeld kann negative und positive Zahlen mit oder ohne Nachkommastellen enthalten. Hier kann unter anderem der Wertebereich des Zahlenfeldes angepasst werden.');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Legend', 'Zahlenfeld-Einstellungen');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Value', 'Value');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Min', 'Minimum');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Max', 'Maximum');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Step', 'Schrittweite');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Required', 'Pflichtfeld');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.DisableFrontendValidation', 'HTML-Validierung ausschalten');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Submit', 'Speichern');

$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Name.Validation.Required.Missing', 'Der Name muss gesetzt sein');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Min.Validation.Number.NotParsed', 'Minimum muss eine ganze oder eine Fließkommazahl sein');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Max.Validation.Number.NotParsed', 'Maximum muss eine ganze oder eine Fließkommazahl sein');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Step.Validation.Number.NotParsed', 'Schrittweite muss eine ganze oder eine Fließkommazahl sein');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Step.Validation.Number.ExceedsMin_{0}', 'Schrittweite muss positiv oder 0 sein');

//Wordings
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Validation-Required-Missing', 'Muss angekreuzt sein');
$translator->AddTranslation($lang, 'Forms.RadioForm.Validation-Required-Missing', 'Bitte eine Auswahl treffen');
$translator->AddTranslation($lang, 'Forms.SelectForm.Validation-Required-Missing', 'Bitte eine Option selektieren');

$translator->AddTranslation($lang, 'Forms.TextfieldForm.Validation-Required-Missing', 'Text ausfüllen');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Validation.PhpFilter-InvalidUrl', 'Ungültige Webadresse');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Validation.PhpFilter-InvalidEmail', 'Ungültige E-Mail-Adresse');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Validation-StringLength-TooShort_{0}', 'Mindestens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Validation-StringLength-TooLong_{0}', 'Höchstens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Validation-RegExp-NoMatch', 'Ungültige Zeichenfolge');

$translator->AddTranslation($lang, 'Forms.TextareaForm.Validation-Required-Missing', 'Text ausfüllen');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Validation-StringLength-TooShort_{0}', 'Mindestens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Validation-StringLength-TooLong_{0}', 'Höchstens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Validation-RegExp-NoMatch', 'Ungültige Zeichenfolge');
        
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Validation-Required-Missing', 'Zahl eintragen');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Validation-Number-NotParsed', 'Keine Zahl erkannt');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Validation-Number-ExceedsMax_{0}', 'Zahl darf den Wert {0} nicht überschreiten');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Validation-Number-ExceedsMin_{0}', 'Zahl darf den Wert {0} nicht untererschreiten');