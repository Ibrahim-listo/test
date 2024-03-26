<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest; // Importing the UpdatePasswordRequest class

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * This method updates the user's password using the UpdatePasswordRequest instance.
     * It first checks if the request is valid, then updates the user's password in the database
     * with the new hash of the provided password.
     * Finally, it redirects the user to the profile page with a success message.
     *
     * @param UpdatePasswordRequest $request The UpdatePasswordRequest instance
     * @return \Illuminate\Http\RedirectResponse The redirect response to the profile page
     */
    public function update(UpdatePasswordRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->update([ // Updating the user's password in the database
            'password' => Hash::make($request->password), // Hashing the new password
        ]);

        return redirect()->route('profile.show')->with('success', 'Your password has been updated!'); // Redirecting to the profile page
    }
}


<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * This method always returns true, meaning any user can make this request.
     *
     * @return bool True if the user is authorized, false otherwise
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * This method defines the validation rules for the request. It checks if the current password is correct
     * and if the new password meets the minimum length requirement and is confirmed.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string> The validation rules
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (! Hash::check($value, $this->user()->password)) { // Checking if the current password is correct
                    $fail('The
