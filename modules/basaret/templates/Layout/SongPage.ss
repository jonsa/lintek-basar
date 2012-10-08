<% if Title %><h1 class="title">$Title</h1><% end_if %>
<% if ValidFile %>
<object width="220" height="20" data="$PlayerPath" type="application/x-shockwave-flash">
<param name="bgcolor" value="#ffffff" />
<param name="FlashVars" value="mp3=/$FilePath&amp;showstop=1&amp;showvolume=1&amp;volumewidth=26&amp;volumeheight=10&amp;bgcolor=ffffff&amp;bgcolor1=896B97&amp;bgcolor2=3B1B4B&amp;slidercolor1=ffffff&amp;slidercolor2=ffffff&amp;sliderovercolor=ffff00" />
<param name="src" value="$PlayerPath" />
</object>
<% end_if %>
$Content
