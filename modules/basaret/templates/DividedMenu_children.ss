<% if Children %>
<ul>
	<% control Children %>
	<li class="$LinkingMode<% if Children %> has-children<% end_if %>"><a href="$Link">$MenuTitle</a>
		$RenderChildren
	</li>
	<% end_control %>
</ul>
<% end_if %>