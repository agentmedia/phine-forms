= phine-forms =

The forms phine bundle allows building forms that can be sent via e-mail or stored in the database.
A wide range of validations can be applied to the form elements.

== Version history ==

=== 1.0.0 ==

Included are the following form parts
- Checkbox
- Fieldset
- Form
- Radio (buttons)
- Select (box)
- Submit (rendered as <input type="submit">)
- Textarea
- Textfield

=== 1.0.0 - 1.0.4 ===

Multiple translation additions

=== 1.0.5, 1.0.6 ===

- Removed "number" from text field types enum and made it its own field
- added "tel" to text field types
- added minlength to text field
- added minlength, maxlength and pattern to textarea (validated in PHP after post-back)

=== 1.0.7 ===

 - corrected number parsing in number field form

=== 1.0.8 ===

 - corrected step size handling and removing some invalid code

=== 1.0.9 ===

- corrected the step attribute to default to "any"

=== 1.1.0 ===

- Multiple Changes to allow disabling html validation

=== 1.1.0 ===

- Multiple Changes to allow disabling html validation

=== 1.1.1 ===

- Fixed Bug with the number field

=== 1.1.2 ===

- Reformatted textarea form to look better

=== 1.2.0, 1.2.1 ===

- Added customizable error texts