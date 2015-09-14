/*
 * Repeater field v0.1 | @agareginyan
 */

jQuery(document).ready(function($) {

 // Add a new repeating section
 var attrs = ['for', 'id', 'name'];

 function resetAttributeNames(section) {
    var tags = section.find('textarea, input, label'),
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
                          alert("Cannot delete the last field.  If you do not require this field then leave it blank.");
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

 // Show/hide button text toggle
 $('.showHide').click(function () {
	$('span', this).toggle();
 });

});
