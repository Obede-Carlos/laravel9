<?php

namespace App\Policies;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublisherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    //TOdo el mundo puede ver el index al poner true.
    public function viewAny(User $user)
    {
        return true; //Con true permitimos a todos usuarios. Con false restringimos todo el acceso (Aparece error 403)
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    /*Establecemos abajo que solamente el usuario con id 1 pueda ver los productos con número par. El que no sea id 1 no podrá ver nada y si es producto impar tampoco
    if ($user->id = 1) {
        return $product->id % 2 == 0;
    } else {
        return false;
    }*/
    public function view(User $user, Publisher $publisher)
    {
       return true; 
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->name == 'benito') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    /*Regla para limitar que solamente el usuario con nombre "Jhonny Melavo" pueda modificar las lineas impares
    if ($user->name == "Jhonny Melavo") {
        return $product->id % 2 == 1;
    } else {
        return false;
    }*/
    public function update(User $user, Publisher $publisher)
    {
        if ($user->name == 'benito') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Publisher $publishert)
    {
        return $user->name == 'benito' ? true : false;
    }

    //Regla personalizada. Ponemos que solamente el usuario "Eduardo" pueda cambiar el precio
    public function changePrice(User $user, Publisher $publisher){
        return $user->name ="Eduardo";
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Publisher $publisher)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Publisher $publisher)
    {
        //
    }
}
