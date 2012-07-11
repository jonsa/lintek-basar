<% if Menu %>
<div class="$Type">
<ul>
	<% control Menu %>
		<li class="$LinkingMode $FirstLast<% if Children %> has-children<% end_if %>"><a href="$Link">$MenuTitle</a>
			<% if Top.IncludeChildren %><% include DividedMenu_children %><% end_if %>
		</li>
	<% end_control %>
</ul>
</div>
<% end_if %>