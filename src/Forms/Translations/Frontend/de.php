<?php
use Phine\Framework\Localization\PhpTranslator;
$translator = PhpTranslator::Singleton();
$lang = 'de';

$translator->AddTranslation($lang, 'Forms.Checkbox.Validation.Required.Missing', 'Muss angekreuzt sein');

$translator->AddTranslation($lang, 'Forms.Radio.Validation.Required.Missing', 'Bitte eine Auswahl treffen');

$translator->AddTranslation($lang, 'Forms.Select.Validation.Required.Missing', 'Bitte eine Option selektieren');

$translator->AddTranslation($lang, 'Forms.Textfield.Validation.Required.Missing', 'Text ausfüllen');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.PhpFilter.InvalidUrl', 'Ungültige Webadresse');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.PhpFilter.InvalidEmail', 'Ungültige E-Mail-Adresse');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.StringLength.TooShort_{0}', 'Mindestens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.StringLength.TooLong_{0}', 'Höchstens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.RegExp.NoMatch', 'Ungültige Zeichenfolge');

$translator->AddTranslation($lang, 'Forms.Textarea.Validation.Required.Missing', 'Text ausfüllen');
$translator->AddTranslation($lang, 'Forms.Textarea.Validation.StringLength.TooShort_{0}', 'Mindestens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.Textarea.Validation.StringLength.TooLong_{0}', 'Höchstens {0} Zeichen eingeben');
$translator->AddTranslation($lang, 'Forms.Textarea.Validation.RegExp.NoMatch', 'Ungültige Zeichenfolge');
        
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Required.Missing', 'Zahl eintragen');
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Number.NotParsed', 'Keine Zahl erkannt');
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Number.ExceedsMax_{0}', 'Zahl darf den Wert {0} nicht überschreiten');
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Number.ExceedsMin_{0}', 'Zahl darf den Wert {0} nicht untererschreiten');