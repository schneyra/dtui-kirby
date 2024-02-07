<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class UrlTest extends TestCase
{
    public function testUrlRespondsWith200(): void
    {
        $urls = [
            'https://dtui-kirby.ddev.site/suche?s=k%C3%A4sebrot', // Suche
            'https://dtui-kirby.ddev.site/kategorie/auf-den-lofoten', // Kategorie-Seite
            'https://dtui-kirby.ddev.site/2023/02/von-einer-mueden-woche', // Blogpost
            'https://dtui-kirby.ddev.site/impressum/', // Seite
            'https://dtui-kirby.ddev.site/feed/' // RSS-Feed
        ];

        foreach ($urls as $url) {
            $this->assertNotFalse(strpos(get_headers($url)[0],'200'));
        }
    }

    public function testUrlIsRedirectedCorrectly(): void
    {
        $urls = [
            [
                'oldUrl' => 'https://dtui-kirby.ddev.site/2023/02/15/von-einer-mueden-woche', // Blogpost mit Tag in URL
                'newUrl' => 'https://dtui-kirby.ddev.site/2023/02/von-einer-mueden-woche'
            ],
            [
                'oldUrl' => 'https://dtui-kirby.ddev.site/von-einer-mueden-woche', // Blogpost ohne Datum in URL
                'newUrl' => 'https://dtui-kirby.ddev.site/2023/02/von-einer-mueden-woche'
            ],
        ];

        foreach ($urls as $url) {
            $headers = get_headers($url['oldUrl']);

            var_dump($headers);

            // Alte URL wird weitergeleitet
            $this->assertNotFalse(strpos($headers[0],'301'));

            // Neue URL ist wie erwartet
            $this->assertEquals('Location: ' . $url['newUrl'], $headers[6]);

            // Neue antwortet mit dem richtigen Statuscode
            $this->assertNotFalse(strpos($headers[15],'200'));
        }
    }

    public function testUrlRespondsWith404(): void
    {
        $urls = [
            'https://dtui-kirby.ddev.site/lol',
        ];

        foreach ($urls as $url) {
            $this->assertNotFalse(strpos(get_headers($url)[0],'404'));
        }
    }
}
