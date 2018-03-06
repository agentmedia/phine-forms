<?php
use Phine\Framework\Localization\PhpTranslator;
$translator = PhpTranslator::Singleton();
$lang = 'en';

$translator->AddTranslation($lang, 'Forms.Checkbox.Validation.Required.Missing', 'Must be checked');

$translator->AddTranslation($lang, 'Forms.Radio.Validation.Required.Missing', 'Select an option');

$translator->AddTranslation($lang, 'Forms.Select.Validation.Required.Missing', 'Select an option');

$translator->AddTranslation($lang, 'Forms.Textfield.Validation.Required.Missing', 'Enter text');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.PhpFilter.InvalidUrl', 'Invalid URL');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.PhpFilter.InvalidEmail', 'Invalid e-mail address');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.StringLength.TooShort_{0}', 'Enter at least {0} characters');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.StringLength.TooLong_{0}', 'Enter no more than {0} characters');
$translator->AddTranslation($lang, 'Forms.Textfield.Validation.RegExp.NoMatch', 'Invalid format');

$translator->AddTranslation($lang, 'Forms.Textarea.Validation.Required.Missing', 'Insert text');
$translator->AddTranslation($lang, 'Forms.Textarea.Validation.StringLength.TooShort_{0}', 'Enter at least {0} characters');
$translator->AddTranslation($lang, 'Forms.Textarea.Validation.StringLength.TooLong_{0}', 'Enter no more than {0} characters');
$translator->AddTranslation($lang, 'Forms.Textarea.Validation.RegExp.NoMatch', 'Invalid format');
        
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Required.Missing', 'Enter number');
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Number.NotParsed', 'No number recognized');
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Number.ExceedsMax_{0}', 'Number must not be more than {0}');
$translator->AddTranslation($lang, 'Forms.Numberfield.Validation.Number.ExceedsMin_{0}', 'Number must be at least {0}');