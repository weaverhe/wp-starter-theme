<?php
/**
 * The homepage template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package starter-theme
 */

get_header(); ?>

	<h1>Header Level One</h1>

	<h2>Header Level Two</h2>

	<h3>Header Level Three</h3>

	<h4>Header Level Four</h4>

	<h5>Header Level Five</h5>

	<h6>Header Level Six</h6>

	<p>Irony leggings tattooed bespoke cronut pour-over next level ennui organic food truck. Schlitz banjo cold-pressed 8-bit. Typewriter swag vegan chambray, <small>lomo beard</small> keytar stumptown Etsy pork belly Echo Park wayfarers food truck. Food truck keffiyeh asymmetrical, ugh twee vinyl authentic Odd<sup>2</sup> Future banjo trust fund leggings lumbersexual <code>inline code</code>heirloom. Put a bird on it Godard pickled pug, Marfa actually literally ennui fashion axe YOLO. Salvia Shoreditch hella, tousled tattooed meggings ethical Pinterest kitsch. Wolf single-origin coffee twee, blog ugh VHS plaid Williamsburg iPhone street art gastropub master cleanse direct trade.</p>

<blockquote>Irony leggings tattooed bespoke cronut pour-over next level ennui organic food truck. Schlitz banjo cold-pressed 8-bit. Typewriter swag vegan chambray.</blockquote>

	<p>Etsy jean shorts paleo Brooklyn narwhal, biodiesel cray pork belly disrupt salvia VHS fap. Lumbersexual iPhone next level, biodiesel hashtag ugh VHS lo-fi ennui <a href="#">cronut mlkshk fanny pack Portland</a>. Thundercats meditation whatever seitan. Authentic vinyl cold-pressed, literally Portland church-key Truffaut semiotics cred <sub>ethical.</sub> Kitsch chambray narwhal cornhole, meh pop-up High Life kogi tofu heirloom raw denim. PBR taxidermy shabby chic, 3 wolf moon skateboard cornhole pork belly +1 Marfa McSweeney's cred ugh master cleanse. Craft beer pop-up kogi leggings Pinterest normcore.</p>

<table>
	<caption>Example Table Title</caption>
	<thead>
		<tr>
			<th>Column 01</th>
			<th>Column 02</th>
			<th>Column 03</th>
			<th>Column 04</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Item 01</td>
			<td>Item 01</td>
			<td>Item 01</td>
			<td>Item 01</td>
		</tr>
		<tr>
			<td>Item 02</td>
			<td>Item 02</td>
			<td>Item 02</td>
			<td>Item 02</td>
		</tr>
		<tr>
			<td>Item 03</td>
			<td>Item 03</td>
			<td>Item 03</td>
			<td>Item 03</td>
		</tr>
	</tbody>
</table>

<pre><code class="language-css">

.bold {
	font-weight: 700;
}

.italic {
	font-style: italic;
}

</code></pre>

<hr>

<button>Primary Button</button>

<input type="submit" value="Submit Button">

<ol>
	<li>List Item 
		<ol>
			<li>List Item</li>
			<li>List Item</li>
		</ol>
	</li>
	<li>List Item 
		<ul>
			<li>Item</li>
			<li>Item</li>
		</ul>
	</li>
	<li>List Item</li>
</ol>

<ul>
	<li>List Item
		<ul>
			<li>Nest Item</li>
			<li>Nest Item</li>
		</ul>
	</li>
	<li>List Item</li>
	<li>List Item</li>
</ul>

<form>
	<label>First Name</label><br>
	<input type="text"><br>

	<label>Last Name</label><br>
	<input type="text"><br>

	<label>Message</label><br>
	<textarea></textarea><br>

	<input type="submit" value="Send">

</form>

<?php get_footer(); ?>

