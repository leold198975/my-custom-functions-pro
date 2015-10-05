/*
 * My Custom Functions Pro
 * Repeater field
 * v 0.1
 * @agareginyan
 */


jQuery(document).ready(function($) {

 // Adding numbers to attribute names 
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

 // Add a new repeating section
 /*$('.addAnotherSection').click(function (e) {
    e.preventDefault();
    var lastRepeatingGroup = $('.repeatingSection').last();
    var cloned = lastRepeatingGroup.clone(true)
    cloned.insertAfter(lastRepeatingGroup);
    resetAttributeNames(cloned)
 });*/

 // Count
 var countadd_field = 0;

 // Add a new repeating section
 $('.addAnotherSection').click(function (e) {
    e.preventDefault();

    countadd_field = countadd_field + 1;

    // THE FOLLOWING HTML IS PREPARED BY PHP AND INSERTED AS A VARIABLE LIKE
    // $(this).before(\''.$js_code.'\');

    $(this).before('<div class="repeatingSection"><h3><label for="labels[' + countadd_field + ']">Label:</label><input type="text" name="labels[' + countadd_field + ']" id="labels[' + countadd_field + ']" size="50%" value="" /></h3><span class="func" style="//display: none;"><textarea name="anarcho_cfunctions_pro_functions[' + countadd_field + ']" id="anarcho_cfunctions_pro_functions[' + countadd_field + ']" class="func_editor" ><?php echo esc_attr( get_option( "anarcho_cfunctions_pro_functions[' + countadd_field + ']" ) ); ?></textarea></span><button type="button" class="button showHide"><span><?php _e( "Show", "anarcho_cfunctions_pro" ); ?></span><span style="display: none"><?php _e( "Hide", "anarcho_cfunctions_pro" ); ?></span></button><button type="button" class="button-primary deleteSection" style="float:right;"><?php _e( "Delete", "anarcho_cfunctions_pro" ); ?></button></div>');

    //$(".repeatingSection").append('<button type="button" class="button showHide"><span><?php _e( "Show", "anarcho_cfunctions_pro" ); ?></span><span style="display: none"><?php _e( "Hide", "anarcho_cfunctions_pro" ); ?></span></button><button type="button" class="button-primary deleteSection" style="float:right;"><?php _e( "Delete", "anarcho_cfunctions_pro" ); ?></button>');
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
