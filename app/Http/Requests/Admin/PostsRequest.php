<?php

namespace App\Http\Requests\Admin;

use App\Model\Post;
use Illuminate\Foundation\Http\FormRequest;
use App\Model\User;

class PostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $author = User::with('posts')->find($this->user_id);
        $canBeAuthor = $author ? $author->canBeAuthor() : false;

        $this->merge([
            'can_be_author' => $canBeAuthor
        ]);

        $this->merge([
            'slug' => str_slug($this->input('title'))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $article = $this->route()->parameter('article');
        return [
            'title' => 'required',
            'description' => 'required',
            //'can_be_author' => 'required|accepted',
            'slug' => 'unique:posts,slug,' . ($article ? $article : null),
            'background' => 'dimensions:min_width=1280,min_height=720',
            'thumb_nail' => 'dimensions:min_width=510,min_height=287',
            'categories' => 'required'
        ];
    }
}
