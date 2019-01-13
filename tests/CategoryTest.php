<?php

class CategoryTest extends TestCase
{
    public function testCreateCategory()
    {
        $data = factory(\App\Category::class)->make()->toArray();
        
        $this->post('category', $data);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $data['name'],
         ]);
    }

    public function testListCategory()
    {
        $data = \App\Category::first();

        $this->get('category');
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $data->name,
        ]);
    }

    public function testShowCategory()
    {
        $category = \App\Category::first();
        $this->get('category/'.$category->id);
        $this->seeStatusCode(200);
        $this->seeJsonContains([
            'name' => $category->name,
        ]);
    }

    public function testUpdateCategory()
    {
        $category = \App\Category::first();
        $name = $category->name;
        $category->name = null;
        $this->put('category/'.$category->id, $category->toArray());
        $this->seeStatusCode(422);

        $name = str_replace("-Updated", "", $name);

        $category->name = $name.'-Updated';
        $this->put('category/'.$category->id, $category->toArray());
        $this->seeStatusCode(200);
        $this->seeJson([
            'name' => $category->name,
         ]);
    }
}
