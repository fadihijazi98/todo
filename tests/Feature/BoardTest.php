<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Color;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $board, $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->seed();

        $this->user = $this->signIn();

        $this->board = [
            'name' => 'fake',
            'user_id' => $this->user->id,
            'color_id' => Color::first()->id
        ];
    }

    /** @test */
    public function a_user_can_create_a_new_board()
    {
        $board = $this->insertNewBoard();

        $this->assertEquals($this->board['name'], $board->name);

        // test board id to enable share the board, hint: use uniqid()
        $this->assertEquals(13, strlen($board->share_board_id));

        // make sure relations are built
        $this->assertEquals($this->user->id, $board->user->id);
        $this->assertEquals($this->board['color_id'], $board->color->id);
    }

    /** @test */
    public function a_user_can_update_his_board()
    {
        $request = $this->sendRequest('/board/555', 'put', [], 'board');

        $request->assertStatus(404);

        $board = $this->insertNewBoard();

        $this->board['name'] = 'name updated';
        $shareBoardIdShouldNotUpdated = $board->share_board_id;

        $boardUpdated = $this->updateABoard($board->id);

        $this->assertEquals('name updated', $boardUpdated->name);

        $this->assertEquals($shareBoardIdShouldNotUpdated, $boardUpdated->share_board_id);
    }

    /** @test */
    public function a_user_can_delete_his_board()
    {
        $board = $this->insertNewBoard();

        $request = $this->deleteABoard($board->id);

        $request->assertStatus(302);
    }

    /** @test */
    public function a_validation_must_failed_when_the_name_is_not_present()
    {
        $this->board['name'] = '';

        $request = $this->sendRequest('/board', 'post', $this->board);

        $request->assertStatus(302);
    }

    /** @test */
    public function a_validation_must_failed_when_the_color_is_not_present()
    {
        $this->board['color_id'] = '';

        $request = $this->sendRequest('/board', 'post', $this->board);

        $request->assertStatus(302);
    }

    /** @test */
    public function a_validation_must_failed_when_the_color_id_is_not_in_colors_table()
    {
        $this->board['color_id'] = 555;

        $request = $this->sendRequest('/board', 'post', $this->board);

        $request->assertStatus(302);
    }

    /** @test */
    public function a_validation_must_failed_when_the_user_id_is_not_in_users_table()
    {
        $this->board['user_id'] = 555;

        $request = $this->sendRequest('/board', 'post', $this->board);

        $request->assertStatus(302);
    }

    private function insertNewBoard()
    {
        return $this->handleResponseRequest('/board', 'post', $this->board, 'board');
    }

    private function updateABoard($id)
    {
        return $this->handleResponseRequest(('/board/' . $id), 'put', $this->board, 'board');
    }

    private function deleteABoard($id)
    {
        return $this->sendRequest('/board/' . $id, 'delete', []);
    }
}
