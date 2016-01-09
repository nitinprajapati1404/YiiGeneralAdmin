/* 
 * Desc - used to add comments with tag in every form
 * Created By - Hetal Patel
 * Date - 10/07/2015
 */
/* function for load tags in div*/ 
$(document).ready(function(e){
loadTags();
});
function setTagContent()
{
    var taggedUserIds = $('.red').map(function(i,n) {
    return $(n).attr('id');
   }).get().join(',');
   $('#taggedUserHidden').val(taggedUserIds);
   var content = $('#contentbox').html();
   content = content.replace(/<div/g, "@<div");
   $('#contentboxHidden').val(content);
}
function loadTags()
{
    var start=/@/ig;
    var word=/@(\w+)/ig;
    $("#contentbox").on("keyup",function(e) 
    {
        var content=$(this).text();
        var go= content.match(start);
        var name= content.match(word);
        $("#contentboxHidden").val('');
        var contentHidden = $("#contentbox").html().replace(/&nbsp;/g, "").replace(/\s+/g, '').replace(/<br>/g, "").replace(/<div><\/div>/g,"");
        contentHidden = contentHidden.replace(/<div> <\/div>/g,"");
        $("#contentboxHidden").val(contentHidden);
        var dataString = 'searchword='+ name;
        var url=siteurl+"adminGroupMaster/getAllUsers" ;
        if(typeof(go)!= 'undefined' &&  go!= '' && go != null & go != 'null')
        {
            //if(go.length >0)
            $("#msgbox").slideDown('show');
            //$("#display").slideUp('show');
            $("#msgbox").html("Type the name of someone...");
            if(typeof(name)!= 'undefined' && (name != '' && name != null && name != 'null'))
            {	
                if(name.length >0){
                $.ajax({
                 url: url,
                 type: 'POST',
                 data: dataString,
                 global:false,
                 success: function(data) 
                 {
                    $("#msgbox").hide();
                    $("#display").html(data).show();
                 },
                 });
             }
            }
        }
     //   console.log($.trim($(this).text()));
        return false;
    });
    $("#display").delegate(".addname","click",function(event) 
    {
        event.preventDefault();
	var username=$(this).attr('title');
        var id=$(this).attr('id');
        var old=$("#contentbox").html();
        var content=old.replace(word," "); //replacing @abc to (" ") space
        $("#contentbox").html(content);
        var E="<div class='red' contenteditable='false'   id="+id+">"+username+"<span class='closetag' title='delete'  onclick='deleteTag("+id+");'/></div>";
        //$("#contentboxHidden").val('');
        $("#contentbox").append(E);
        $("#display").hide();
        $("#msgbox").hide();
        $("#contentbox").focus();
        placeCaretAtEnd($('#contentbox').get(0));
    });
}
$("#contentbox").blur(function(){
     $("#contentboxHidden").focus().blur();
      
}) 
/* used to set focus at the end of string */
function placeCaretAtEnd(el) {
    el.focus();
    if (typeof window.getSelection != "undefined" && typeof document.createRange != "undefined") 
    {
        var range = document.createRange();
        range.selectNodeContents(el);
        range.collapse(false);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } 
    else if (typeof document.body.createTextRange != "undefined") 
    {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.collapse(false);
        textRange.select();
    }
}
/* used to remove tag */
function deleteTag(id)
{
    $("#"+id).remove();
}