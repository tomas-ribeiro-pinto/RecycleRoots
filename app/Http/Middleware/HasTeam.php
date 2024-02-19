<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TeamInvitation;
use App\Actions\Jetstream\AddTeamMember;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::user()->currentTeam->count() === 0) {
            //check to see if there is a pending invite.
            $invitation = TeamInvitation::where('email', '=', Auth::user()->email)->first();
            if ($invitation) {
                app(AddTeamMember::class)->add(
                    $invitation->team->owner,
                    $invitation->team,
                    $invitation->email,
                    $invitation->role
                );

                $invitation->delete();
                return redirect(config('fortify.home'))->banner(
                    __('Great! You have accepted the invitation to join the :team team.', ['team' => $invitation->team->name]),
                );
            }else{
                return abort(403);
            }
        }

        return $next($request);
    }
}
