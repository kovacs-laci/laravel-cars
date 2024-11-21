<?php

namespace Tests\Browser;

use App\Models\User;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    use DatabaseTruncation;

    /**
     * @var array
     */
    protected $tablesToTruncate = ['users'];

    /**
     * Create the RemoteWebDriver instance.
     */
    protected function driver(): RemoteWebDriver
    {
        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()
        );
    }

        /**
     * Prepare for Dusk test execution.
     */
    public static function prepare(): void
    {
         static::startChromeDriver(['port' => 9516]);
//         static::startChromeDriver(['--port=9515']);
//         DesiredCapabilities::chrome()->setCapability('chromeOptions', [
//            'args' => ['--disable-gpu', '--headless', '--no-sandbox', '--disable-dev-shm-usage', '--window-size=1920,1080'],
//        ]);

    }

    public function testMenuLogin()
    {
//        DesiredCapabilities::chrome();

        $user = User::factory()->create([
            'email' => 'test@test.hu',
            'password' => bcrypt('12345678')
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->pause(1000)
                ->assertSeeLink('Login');
//                ->waitForLink('Login');
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', $user->password)
                ->press('Login')
                ->assertPathIs('/');
        });
    }
    /**
     * Test menu contains specific links.
     */

    /**
     * Test clicking a link.
     */
//    public function testClickingAboutLink()
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/')
//                ->clickLink('Gyártók')
//                ->assertPathIs('/makers')
//                ->assertSeeIn('h1','Gyártók');
//        });
//    }
}

