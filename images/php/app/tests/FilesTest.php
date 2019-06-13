<?php

use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Testing\Concerns\MakesHttpRequests;

class FilesTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testGetAllImagesList()
    {
        $response = $this->call(
            'POST',
            '/files',
            [],
            [],
            [
                'file' => UploadedFile::fake()->image('image.png')
            ]
        );
        
        $response = $response->getData();

        $this->assertEquals(
            $response->name, 'image.png'
        );

        $response = $this->call(
            'GET',
            '/files'
        );
        
        $response = $response->getData();

        $this->assertTrue(
            is_array($response)
        );
    }

    /**
     *
     * @return void
     */
    public function testPostImage()
    {
        $response = $this->call(
            'POST',
            '/files',
            [],
            [],
            [
                'file' => UploadedFile::fake()->image('image.png')
            ]
        );
        
        $response = $response->getData();

        $this->assertEquals(
            $response->name, 'image.png'
        );

    }

    /**
     *
     * @return void
     */
    public function testGetImage()
    {
        $file = UploadedFile::fake()->image('image.png');
        $data = $file->get();

        $response = $this->call(
            'POST',
            '/files',
            [],
            [],
            [
                'file' => $file
            ]
        );
        
        $response = $response->getData();

        $this->assertEquals(
            $response->name, 'image.png'
        );

        $response = $this->call(
            'GET',
            sprintf('/files/%s', $response->id)
        );
        
        $response = $response->getData();

        $this->assertEquals(
            $response->name, 'image.png'
        );

        $this->assertEquals(
            $response->base64_content, base64_encode($data)
        );
    }

    /**
     *
     * @return void
     */
    public function testDeleteImage()
    {
        $file = UploadedFile::fake()->image('image.png');
        $data = $file->get();

        $response = $this->call(
            'POST',
            '/files',
            [],
            [],
            [
                'file' => $file
            ]
        );
        
        $response = $response->getData();

        $this->assertEquals(
            $response->name, 'image.png'
        );

        $response = $this->call(
            'DELETE',
            sprintf('/files/%s', $response->id)
        );
        
        $response = $response->getData();
    }

    /**
     *
     * @return void
     */
    public function testGetStorageUsed()
    {
        $response = $this->call(
            'POST',
            '/files',
            [],
            [],
            [
                'file' => UploadedFile::fake()->image('image.png')
            ]
        );
        
        $response = $response->getData();

        $this->assertEquals(
            $response->name, 'image.png'
        );

        $response = $this->call(
            'GET',
            '/files/storage'
        );
        
        $response = $response->getData();

        $this->assertTrue(
            property_exists($response, 'spaceUsed')
        );
    }
}
