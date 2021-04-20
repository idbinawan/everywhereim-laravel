import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ColorEditComponent } from './components/color-edit/color-edit.component';
import { UsersListComponent } from './components/users-list/users-list.component';

const routes: Routes = [
  { path: '', component: UsersListComponent },
  { path: 'color', component: ColorEditComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
