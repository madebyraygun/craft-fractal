---
to: <%= `fractal/components/${typePath}/${baseName}/${baseName}.twig` %>
---

<div class="content-block block--<%= baseName %>">
	<div class="inner">
		<div class="block-heading">
			<h2 class="heading-2">{{sectionHeading}}</h2>
		</div>
		<div class="block-content">
			<p>{{body}}</p>
		</div>
	</div>
</div>