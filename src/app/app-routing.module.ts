import { AuthGuardService } from './login/auth-guard.service';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { AppComponent } from './app.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { MessangerComponent } from './messanger/messanger.component';
import { NewsfeedComponent } from './pages/newsfeed/newsfeed.component';
import { GroupsComponent } from './groups/groups.component';


const appRoutes: Routes = [
  { path: '', component: HomeComponent, canActivate: [AuthGuardService],
    children: [
      {path: '', component: NewsfeedComponent , data: {title: 'Newsfeed'}} ,
      {path: 'messages', component: MessangerComponent, data: {title: 'Messanger'}},
      {path: 'groups', component: GroupsComponent, data: {title: 'Groups'}}
    ]
  },
  { path: 'login', component: LoginComponent, data: {title: 'Login'}}
];


@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }