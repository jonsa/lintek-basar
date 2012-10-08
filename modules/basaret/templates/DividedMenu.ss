<% if Menu %>
<div class="$Type">
<ul class="nav <% if Type = dm-topmenu %>nav-pills<% else %>nav-list<% end_if %>">
	<% if Type = dm-submenu %><li class="nav-header">$Level(1).MenuTitle</li><% end_if %>
	<% control Menu %>
		<li class="$LinkingMode $FirstLast<% if Children %> has-children<% end_if %>"><a href="$Link">$MenuTitle</a>
			<% if Top.IncludeChildren %><% include DividedMenu_children %><% end_if %>
		</li>
	<% end_control %>
</ul>
</div>
<% end_if %>