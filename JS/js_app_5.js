function hide_div(id)
{
  if (document.getElementById(id).style.display == 'none')
  {
       document.getElementById(id).style.display = 'block';
       document.getElementById('login').style.display = 'none';
       document.getElementById('img').style.display = 'none';
  }
  else
  {
       document.getElementById(id).style.display = 'none';
       document.getElementById('login').style.display = 'block';
       document.getElementById('img').style.display = 'block';
  }
}
function hide_div_reverse(id)
{
  if (document.getElementById(id).style.display == 'block')
  {
       document.getElementById(id).style.display = 'none';
       document.getElementById('login').style.display = 'block';
       document.getElementById('img').style.display = 'block';
  }
}