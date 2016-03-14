$(document).ready(function()
{
    $('#createForm').on('focus', '.numeric', function()
        {
            $(this).select();            
        });
        
    $('#editForm').on('focus', '.numeric', function()
        {
            $(this).select();            
        });
    
});