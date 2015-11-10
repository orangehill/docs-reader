<?php
namespace App\Http\Controllers;

use Parsedown;
use Config;
use File;
use View;
use DOMDocument;

class DocumentationController extends Controller {

	/**
	 * Displays documentation
	 * @param string $chapter
	 * @return View
	 */
	public function showDocs($chapter = null)
	{

		// Show introduction page by default.
		if ($chapter === null) $chapter = Config::get('docs.home', 'introduction');

		// Build an array of file stubs to load from disk and include the documentation index by default.
		$data = array(
			'chapter'	=> $chapter,
			'index'		=> Config::get('docs.index', 'documentation')
		);

		$parsedown = new Parsedown();

		// Walk through the data array, loading documentation from the filesystem and converting it to
		// markdown for display on the documentation pages.
		array_walk($data, function(&$raw) use ($parsedown) {
			$path = base_path() . Config::get('docs.path', '/docs');
			$raw = File::get($path."/{$raw}.md");
			$raw = $parsedown->text($raw);
		});

		$footerLinks = $this->parseIndex($data['index'], $chapter);

		$data = array_merge($data, $footerLinks);

		// Show the documentation template, which extends our master template
		// and provides a documentation index within the sidebar section.
		return View::make('docs', $data);
	}

	/**
	 * Parse the index to find out the next and previous pages and add links to them in the footer
	 * @param  string $index
	 * @param  string $chapter
	 * @return array
	 */
	public function parseIndex($index, $chapter)
	{
		$dom = new DOMDocument();
		$dom->loadHTML($index);

		$data['prev'] = false;
		$data['next'] = false;
		$foundCurrent = false;
		$data['title'] = '';

		$domLinks = $dom->getElementsByTagName('a');
		foreach ($domLinks as $domLink) {

			$link['URI'] = $domLink->getAttribute('href');
			$link['title'] = $domLink->nodeValue;
			if($foundCurrent)
			{
				$data['next'] = $link;
				break;
			}
			else
			{
				$foundCurrent = (str_replace(Config::get('docs.basehref', '/docs/'), '', $link['URI']) == $chapter);

				if(!$foundCurrent)
					$data['prev'] = $link;
				else
					$data['title'] = $link['title'];
			}
		}
		return $data;
	}

}
