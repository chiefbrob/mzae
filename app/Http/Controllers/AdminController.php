<?php
//level 4

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Contact;
use App\User;
use App\Term;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function interpret($endpoint = 'home', Request $request){

    	if(!Auth::user()->isAnAdmin())
    		return 1;

    	switch ($endpoint) {
    		case 'home':
    			return view('admin.home');
    			break;

    		case 'users':
    			return view('admin.users.index');
    			break;

            case 'searchforusers':
                $sql = "SELECT id FROM users WHERE name like '%".$request->name."%' and role !='admin' limit 10";
                $results = DB::select($sql);
                $ret = array();
                for($i=0; $i<count($results); $i++)
                {
                    $r = $results[$i];
                    $user = User::find($r->id);
                    array_push($ret, $user);
                }
                return $ret;
                break;

            case 'disableuser':

                $user = User::findOrFail($request->user_id);
                $user->status = 'inactive';
                $user->save();
                return 0;
                break;

            case 'enableuser':

                $user = User::findOrFail($request->user_id);
                $user->status = 'active';
                $user->save();
                return 0;
                break;

            case 'contacts':

                $contacts = Contact::orderBy('id', 'desc')->paginate(10);

                return view('admin.contacts.index')
                        ->with('contacts',$contacts);
                break;

            case 'contacts-view':

                $contact = Contact::findOrFail($request->contact_id);

                return view('admin.contacts.preview')
                        ->with('contact',$contact);
                break;

            case 'contacts-resolve':

                $contact = Contact::findOrFail($request->contact_id);
                $contact->notes = $request->notes;
                $contact->resolved_by = $user->id;
                $contact->resolved_on = Carbon::now()->toDateTimeString();
                $contact->save();

                return redirect('/admin/contacts-view?contact_id='.$contact->id);
                break;

            case 'terms':
                return view('admin.terms.index')
                        ->with('terms',Term::all());
                break;

            case 'termsCreate':

                return view('admin.terms.create');

                break;

            case 'termsCreated':

                $term = Term::create([
                    'contents' => $request->contents
                ]);
                return view('admin.terms.created')
                        ->with('term',$term);

                break;

            case 'termsEdit':

                $term = Term::findOrFail($request->term_id);
                return view('admin.terms.edit')
                        ->with('term',$term);

                break;

            case 'termsSave':

                $term = Term::findOrFail($request->term_id);
                $term->contents = $request->contents;
                $term->save();
                return view('admin.terms.updated')
                        ->with('term',$term);

                break;

            case 'termsDelete':

                $term = Term::findOrFail($request->term_id);
                $term->delete();
                return view('admin.terms.deleted');
                        
                break;

    		default:
    			return redirect('/admin');
    			break;
    	}
    }
}
