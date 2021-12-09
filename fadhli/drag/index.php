<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
#div1 {width:350px;height:70px;padding:10px;border:1px solid #aaaaaa;}
</style>
<script>
/*
function allowDrop(ev)
{
ev.preventDefault();
}

function drag(ev)
{
ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev)
{
ev.preventDefault();
var data=ev.dataTransfer.getData("Text");
ev.target.appendChild(document.getElementById(data));
}*/
</script>



</head>
<body>

<p>Drag the W3Schools image into the rectangle:</p>
<!--
<div id="div1"  ondrop="drop(event)" ondragover="allowDrop(event)"></div>
<br>
<img id="drag1" src="img_logo.gif" draggable="true" ondragstart="drag(event)" width="336" height="69">
-->
<center>
<input type="text" class="form-control" name="j_hired_tutor_email" id="j_hired_tutor_email" value="" />
<br>
<label class="label label-primary"  id="drag1" draggable="true" ondragstart="drag(event)" ><a onclick="javascript:myFunc(this.id)" id="fadhlisbmz@gmail.com" href="manage_user.php?action=edit&u_id=12345" target="_blank" title="ID: 12345" style="color:red; text-decoration: none;">test</a></label> 
                                    




</center>
                                   



<script>
       function myFunc(elem) {

         //alert(elem);
         elem.addEventListener("touchmove", myFunction);
      }


//document.getElementById("drag1").addEventListener("touchmove", myFunction);
function myFunction() {
  //document.getElementById("demo").innerHTML = "Hello World";
  alert('test');
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.innerText = document.getElementById(data).innerText;
}
</script>



</body>
</html>










    <link href='https://www.jqueryscript.net/demo/Mobile-Drag-Drop-Plugin-jQuery/demo.css' rel='stylesheet' type='text/css'>
    <!--<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href='https://www.jqueryscript.net/demo/Mobile-Drag-Drop-Plugin-jQuery/draganddrop.css' rel='stylesheet' type='text/css'>
    <link href="https://bootswatch.com/flatly/bootstrap.min.css" rel="stylesheet" type="text/css">-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src='https://www.jqueryscript.net/demo/Mobile-Drag-Drop-Plugin-jQuery/draganddrop.js' type='text/javascript'></script>
    

    <script type='text/javascript'>
      $(function() {
        //grouped lists
        $('ul.grouped').sortable({
          group: true
        });

        //normal list
        $('ul.normal').sortable({
          autocreate: true,
          update: function(evt) {
            console.log(JSON.stringify($(this).sortable('serialize')));
          }
        });

        //remaining lists
        $('ul.float, ul.inline').sortable({
          update: function(evt) {
            console.log(JSON.stringify($(this).sortable('serialize')));
          }
        });

        //div list
        $('.list.parent').sortable({container: '.list', nodes: ':not(.list)'});

        //draggable
        $('.drag').draggable();
        $('.draggables').draggable({delegate: 'button', placeholder: true});
        $('.draghandle').draggable({handle: '.handle', placeholder: true});
        $('.dragdrop').draggable({
          revert: true,
          placeholder: true,
          droptarget: '.drop',
          drop: function(evt, droptarget) {
            $(this).appendTo(droptarget).draggable('destroy');
          }
        });

        //off switch
        $('.off').on('click', function() {
          $('.sortable').each(function() { $(this).sortable('destroy'); });
          $('.draggable').each(function() { $(this).draggable('destroy'); });
        });
      });
    </script>






      
<a id="1234" href="manage_user.php?action=edit&u_id=1234" target="_blank" title="ID: 1234" style="color:red; text-decoration: none;">Drag and Drop me</a>




<label class="label label-primary dragdrop" >test</label> 
                                    
    <button class="btn btn-primary dragdrop"><a id="1234" href="manage_user.php?action=edit&u_id=1234" target="_blank" title="ID: 1234" style="color:red; text-decoration: none;">Drag and Drop me</a></button>


    <div class="drop"><p>Drop here</p></div>

 






<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] == 'Mohd Nurfadhli'){
?>

<script src="https://www.jqueryscript.net/demo/Draggable-Sortable-Plugin-jQuery-Touch-DnD/touch-dnd.js"></script>
<script type="text/javascript">
  $(function() {
    $('#lhs').sortable({ connectWith: '.droppable' })
    $('#rhs').sortable({ connectWith: '#lhs' })
    .on('sortable:receive', function(e, ui) {
      ui.item.removeClass('draggable')
    })
    $('.draggable').draggable({ connectWith: '#rhs' })
    $('.droppable').droppable({ activeClass: 'active', hoverClass: 'drop-here' })
  })
</script>
<?PHP
}
?>














<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
#div1 {width:350px;height:70px;padding:10px;border:1px solid #aaaaaa;}
</style>
<script>
/*
function allowDrop(ev)
{
ev.preventDefault();
}

function drag(ev)
{
ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev)
{
ev.preventDefault();
var data=ev.dataTransfer.getData("Text");
ev.target.appendChild(document.getElementById(data));
}*/
</script>



</head>
<body>

<p>Drag the W3Schools image into the rectangle:</p>
<!--
<div id="div1"  ondrop="drop(event)" ondragover="allowDrop(event)"></div>
<br>
<img id="drag1" src="img_logo.gif" draggable="true" ondragstart="drag(event)" width="336" height="69">
-->
<center>
    <input type="text" class="form-control" name="dummytest" id="dummytest" value="" />
<input type="text" class="form-control" name="j_hired_tutor_email" id="j_hired_tutor_email" value="" />
<br>
<label class="label label-primary"  id="drag1" draggable="true" ondragstart="drag(event)" ><a  ontouchstart="myFunction(this.id)" id="fadhlisbmz@gmail.com" href="manage_user.php?action=edit&u_id=12345" target="_blank" title="ID: 12345" style="color:red; text-decoration: none;">test</a></label> 
                                    




</center>
                                   



<script>
       function myFunc(elem) {

         //alert(elem);
         document.getElementById("drag1").addEventListener("touchmove", myFunction);
      }


//document.getElementById("drag1").addEventListener("touchmove", myFunction);
function myFunction(elem) {
  document.getElementById("dummytest").value = elem;
 //alert(elem);
/*
  var copyText = document.getElementById("dummytest");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
*/
    var copyText = elem;
    var el = document.createElement('textarea');
    el.value = copyText;
    el.setAttribute('readonly', '');
    el.style = {
        position: 'absolute',
        left: '-9999px'
    };
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
 
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.innerText = document.getElementById(data).innerText;
}
</script>



</body>
</html>