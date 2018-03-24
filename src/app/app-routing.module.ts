import { AuthGuardService } from './login/auth-guard.service';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { AppComponent } from './app.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { MessangerComponent } from './messanger/messanger.component';


const appRoutes: Routes = [
  { path: '', component: HomeComponent, canActivate: [AuthGuardService],
    children: [
      {path: 'messages', component: MessangerComponent}
    ]
  },
  { path: 'login', component: LoginComponent }
];


@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }