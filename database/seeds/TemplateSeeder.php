<?php

use Illuminate\Database\Seeder;
use claymalven\Models\Template;

class TemplateSeeder extends Seeder {

	/**
	 * Run the table seed.
	 *
	 * @return void
	 */
	public function run()
	{
		Template::create([
			'name' => 'Contemporary', 
			'website_type' => 'Selling', 
			'preview_thumbnail' => '/selling-templates/previews/thumbs/contemporary1.jpg',
			'description' => 'Contemporary. Crisp. Astonishing.<br />This template is perfect for the seller that wants to crush it and sell more houses.',
			'path' => '/selling-templates/contemporary/'
		]);
		Template::create([
			'name' => 'Clean',
			'website_type' => 'Selling', 
			'preview_thumbnail' => '/selling-templates/previews/thumbs/clean1.jpg',
			'description' => 'Clean and concise.<br />This template is free of clutter and extraneous information.  Buyers will find it easy view your listings.', 
			'path' => '/selling-templates/clean/'
		]);
		Template::create([
			'name' => 'Sharp',
			'website_type' => 'Selling', 
			'preview_thumbnail' => '/selling-templates/previews/thumbs/sharp1.jpg',
			'description' => 'Sharp. Classic. Attractive.<br />This template is perfect for the seller that wants to make the experience better for their buyers.', 
			'path' => '/selling-templates/sharp/'
		]);
		Template::create([
			'name' => 'Modern',
			'website_type' => 'Selling', 
			'preview_thumbnail' => '/selling-templates/previews/thumbs/modern1.jpg',
			'description' => 'Modern. Clean. Awesome.<br />This template is perfect for the investor that wants to crush it and sell more flipped houses than their competition.', 
			'path' => '/selling-templates/modern/'
		]);
		Template::create([
			'name' => 'Grand',
			'website_type' => 'Selling', 
			'preview_thumbnail' => '/selling-templates/previews/thumbs/grand1.jpg',
			'description' => 'Grand. Classy. Easy-to-use.<br />This template is stunning and very simple for potential buyers to engage with.', 
			'path' => '/selling-templates/grand/'
		]);

		Template::create([
			'name' => 'Modern', 
			'website_type' => 'Buying', 
			'preview_thumbnail' => '/templates/previews/thumbs/modern1.jpg',
			'description' => 'Modern. Clean. Awesome.<br />This template is perfect for the investor that wants to crush it and generate better leads than their competition.', 
			'path' => '/buying-templates/modern/'
		]);
		Template::create([
			'name' => 'Grand',
			'website_type' => 'Buying', 
			'preview_thumbnail' => '/templates/previews/thumbs/grand1.jpg',
			'description' => 'Grand. Classy. Easy-to-use.<br />This template is stunning and very simple for potential sellers to engage with.', 
			'path' => '/buying-templates/grand/'
		]);
		Template::create([
			'name' => 'Clean',
			'website_type' => 'Buying', 
			'preview_thumbnail' => '/templates/previews/thumbs/clean1.jpg',
			'description' => 'Clean and concise.<br />This template is free of clutter and extraneous information.  Sellers will find it easy to submit their information.', 
			'path' => '/buying-templates/clean/'
		]);
		Template::create([
			'name' => 'Contemporary',
			'website_type' => 'Buying', 
			'preview_thumbnail' => '/templates/previews/thumbs/contemporary1.jpg',
			'description' => 'Contemporary. Crisp. Astonishing.<br />This template is simple to navigate and designed to make submitting information easy for the seller.', 
			'path' => '/buying-templates/contemporary/'
		]);
		Template::create([
			'name' => 'Sharp',
			'website_type' => 'Buying', 
			'preview_thumbnail' => '/templates/previews/thumbs/sharp1.jpg',
			'description' => 'Sharp. Classic. Attractive.<br />This template is perfect for the investor that wants to make the experience easier for motivated sellers.', 
			'path' => '/buying-templates/sharp/'
		]);

		Template::create([
			'name' => 'Sharp', 
			'website_type' => 'Wholesale', 
			'preview_thumbnail' => '/wholesale-templates/previews/thumbs/sharp1.jpg',
			'description' => 'Sharp. Classic. Attractive.<br />This template is perfect for the wholesale seller that wants to get investors coming back.', 
			'path' => '/wholesale-templates/sharp/'
		]);
		Template::create([
			'name' => 'Contemporary',
			'website_type' => 'Wholesale', 
			'preview_thumbnail' => '/wholesale-templates/previews/thumbs/contemporary1.jpg',
			'description' => 'Contemporary. Crisp. Astonishing.<br />This template is perfect for the seller that wants to crush it and sell more wholesale deals.', 
			'path' => '/wholesale-templates/contemporary/'
		]);
		Template::create([
			'name' => 'Clean',
			'website_type' => 'Wholesale', 
			'preview_thumbnail' => '/wholesale-templates/previews/thumbs/clean1.jpg',
			'description' => 'Clean and concise.<br />This template is free of clutter and extraneous information.  Investors will find it easy view your listings', 
			'path' => '/wholesale-templates/clean/'
		]);
		Template::create([
			'name' => 'Modern',
			'website_type' => 'Wholesale', 
			'preview_thumbnail' => '/wholesale-templates/previews/thumbs/modern1.jpg',
			'description' => 'Modern. Clean. Awesome.<br />This template is perfect for the investor that wants to crush it and sell more wholesale deals than their competition.', 
			'path' => '/wholesale-templates/modern/'
		]);
		Template::create([
			'name' => 'Grand',
			'website_type' => 'Wholesale', 
			'preview_thumbnail' => '/wholesale-templates/previews/thumbs/grand1.jpg',
			'description' => 'Grand. Classy. Easy-to-use.<br />This template is stunning and very simple for potential investors to engage with.',
			'path' => '/wholesale-templates/grand/'
		]);

		Template::create([
			'name' => 'Clean', 
			'website_type' => 'Land', 
			'preview_thumbnail' => '/land-templates/previews/thumbs/clean1.jpg',
			'description' => 'Clean and concise.<br />This template is free of clutter and extraneous information.  Land sellers will find it easy to submit their information.', 
			'path' => '/land-templates/clean/'
		]);


	}

}