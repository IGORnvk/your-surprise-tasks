<?php

namespace Tests\Unit;

use Tests\TestCase;

class ValidationTest extends TestCase
{
    /**
     * test validation with correct data
     */
    public function test_with_correct_data(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 8,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertValid();
        $response->assertContent('Request successfully sent!');
        $response->assertStatus(200);
    }

    /**
     * test validation with missing email
     */
    public function test_with_missing_email(): void
    {
        // Arrange
        $data = [
            'email' => '',
            'likes' => 7,
            'reposts' => 8,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'email' => 'The email field is required.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with invalid email
     */
    public function test_with_invalid_email(): void
    {
        // Arrange
        $data = [
            'email' => 'invalid',
            'likes' => 7,
            'reposts' => 8,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'email' => 'The email field must be a valid email address.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with missing likes
     */
    public function test_with_missing_likes(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => null,
            'reposts' => 8,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'likes' => 'The likes field is required.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with likes value more than 10
     */
    public function test_with_likes_above_10(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 14,
            'reposts' => 8,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'likes' => 'The likes field must not be greater than 10.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with likes value less than 1
     */
    public function test_with_likes_below_1(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 0,
            'reposts' => 8,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'likes' => 'The likes field must be at least 1.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with likes value not being numeric
     */
    public function test_with_not_numeric_likes(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 'test',
            'reposts' => 8,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'likes' => 'The likes field must be a number.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with missing reposts
     */
    public function test_with_missing_reposts(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => null,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'reposts' => 'The reposts field is required.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with reposts value more than 10
     */
    public function test_with_reposts_above_10(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 15,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'reposts' => 'The reposts field must not be greater than 10.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with reposts value less than 1
     */
    public function test_with_reposts_below_1(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 0,
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'reposts' => 'The reposts field must be at least 1.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with reposts value not being numeric
     */
    public function test_with_not_numeric_reposts(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 'test',
            'views' => 10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'reposts' => 'The reposts field must be a number.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with missing views
     */
    public function test_with_missing_views(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 8,
            'views' => null
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'views' => 'The views field is required.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with views value more than 10
     */
    public function test_with_views_above_10(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 8,
            'views' => 12
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'views' => 'The views field must not be greater than 10.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with views value less than 1
     */
    public function test_with_views_below_1(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 8,
            'views' => -5
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'views' => 'The views field must be at least 1.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with views value not being numeric
     */
    public function test_with_not_numeric_views(): void
    {
        // Arrange
        $data = [
            'email' => 'test@test.nl',
            'likes' => 7,
            'reposts' => 8,
            'views' => 'test'
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid([
            'views' => 'The views field must be a number.'
        ]);
        $response->assertStatus(302);
    }

    /**
     * test validation with two invalid values
     */
    public function test_with_two_invalid_values(): void
    {
        // Arrange
        $data = [
            'email' => 'test@',
            'likes' => null,
            'reposts' => 8,
            'views' => 5
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid(['email', 'likes']);
        $response->assertStatus(302);
    }

    /**
     * test validation with three invalid values
     */
    public function test_with_three_invalid_values(): void
    {
        // Arrange
        $data = [
            'email' => 'test@',
            'likes' => null,
            'reposts' => null,
            'views' => 5
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid(['email', 'likes', 'reposts']);
        $response->assertStatus(302);
    }

    /**
     * test validation with four invalid values
     */
    public function test_with_all_invalid_values(): void
    {
        // Arrange
        $data = [
            'email' => 123,
            'likes' => null,
            'reposts' => null,
            'views' => -10
        ];

        // Act
        $response = $this->post('/task-3', $data);

        // Assert
        $response->assertInvalid(['email', 'likes', 'reposts', 'views']);
        $response->assertStatus(302);
    }
}
