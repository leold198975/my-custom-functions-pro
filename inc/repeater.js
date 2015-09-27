/*
 * Repeater field v0.1 | @agareginyan
 */

jQuery(document).ready(function($) {

 // Add a new repeating section
 function resetAttributeNames(section) {
    var tags = section.find('textarea, input, label');
    var attrs = ['for', 'id', 'name'];
    idx = section.index();
    tags.each(function () {
              var $this = $(this);
              $.each(attrs, function (i, attr) {
                     var attr_val = $this.attr(attr);
                     if (attr_val) {
                        $this.attr(attr, attr_val.replace(/_\d+$/, '_' + (idx + 1)))
                     }
              })
    })
 }

 $('.addAnotherSection').click(function (e) {
    e.preventDefault();
    var lastRepeatingGroup = $('.repeatingSection').last();
    var cloned = lastRepeatingGroup.clone(true)
    cloned.insertAfter(lastRepeatingGroup);
    resetAttributeNames(cloned)
 });

 // Delete a repeating section
 $('.deleteSection').click(function (e) {
    e.preventDefault();
    var current_field = $(this).parent('div');
    var other_fields = current_field.siblings('.repeatingSection');
    if (other_fields.length === 0) {
                           alert("Cannot delete the last function. If you do not require this function then leave it blank.");
                          return;
    }
    current_field.slideUp('fast', function () {

                          current_field.remove();

                          // reset field indexes
                          other_fields.each(function () {
                                            resetAttributeNames($(this));
                          })

    })
                          
 });

 // Show/hide entry of field and change text of button
 $('.showHide').click(function (e) {
    e.preventDefault();
    var current_field = $(this).prev('span');
    current_field.toggleClass( 'show' );
    $('span', this).toggle();
 });

});