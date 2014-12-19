function groupSelect(){
  var visibility = document.getElementById('form_visibility').value;
  if(visibility == 'group')
  {
    document.getElementById('groupSelect').style.display = 'inline';
  }
  else if(visibility != 'group' && document.getElementById('groupSelect').style.display != 'none')
  {
    document.getElementById('groupSelect').style.display = 'none';
  }
}