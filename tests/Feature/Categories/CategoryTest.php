<?php

namespace Tests\Feature\Categories;

use App\Events\CategoryEvent;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
//    public function test_example(): void
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    public function test_category_index()
    {
        $user = User::factory()->create();

//        $response = $this->actingAs($user)->get(route('categories.index'));
//        $response->assertOk();

        $response = $this->actingAs($user)->get(route('categories.index'));
        $response->assertStatus(200);
        $categories = Category::factory()->count(2)->create();
//         $response = $this->get('/categories/index');
//         $data = $response->json();
//         $this->assertEquals($categories,count($data));
         foreach($categories as $key => $value)
         {
             $this->assertDatabaseHas('categories',[
                  'id' => $value->id,
                  'name' => $value->name,
             ]);

             $this->assertDatabaseHas('categories',$value->toArray());
         }
    }

    public function test_create()
    {
        $user = User::factory()->create();

        $category = [
            'name' => 'category'
        ];
        $response = $this->actingAs($user)->post(route('categories.store'),$category);
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories',$category);
       // $response->assertJson($category);
    }

    public function test_update()
    {
        $category = Category::factory()->create();
        $data = [
           'name' => 'new Category',
        ];

        $response = $this->put(route('categories.update',$category->id),$data);
        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('categories',$category->toArray());
    }

    public function test_delete()
    {
        $category = Category::factory()->create();
        $response = $this->delete(route('categories.destroy',$category->id));
       // $response->assertStatus(200);
        $this->assertDatabaseMissing('categories',$category->toArray());
    }

    public function test_all_categories()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('categories.index'));
        $categories = Category::factory(4)->create();
        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
       // $response->assertViewHas('categories');
       // $response->assertSee('categories');

        foreach($categories as $key => $value)
        {
            $response->assertSee($value->name);
        }
    }

    public function test_event()
    {
        Event::fake();
        $user = User::factory()->create();

        $category = [
            'name' => 'category',
        ];

        $response = $this->actingAs($user)->post(route('categories.store'),$category);
        $response->assertRedirect(route('categories.index'));

        Event::assertDispatched(CategoryEvent::class, function($e) use ($category) {
             return $e->category->name === $category['name'];
        });

    }
}
