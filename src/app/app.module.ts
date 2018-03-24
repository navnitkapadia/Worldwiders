import { AuthGuardService } from './login/auth-guard.service';
import { AppRoutingModule } from './app-routing.module';
import { RouterModule } from '@angular/router';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import { AngularFireModule } from 'angularfire2';
import { environment } from '../environments/environment';
import { AngularFirestoreModule } from 'angularfire2/firestore';
import { AngularFireStorageModule } from 'angularfire2/storage';
import { AngularFireAuthModule } from 'angularfire2/auth';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';
import { AuthService } from './login/auth.service';
import { HeaderComponent } from './home/header/header.component';
import { UserProfileComponent } from './users/user-profile/user-profile.component';
import { SidebarLeftComponent } from './home/sidebar-left/sidebar-left.component';
import { SidebarRightComponent } from './home/sidebar-right/sidebar-right.component';
import { MessangerComponent } from './messanger/messanger.component';
import { ChatPopupBoxComponent } from './messanger/chat-popup-box/chat-popup-box.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,
    HeaderComponent,
    UserProfileComponent,
    SidebarLeftComponent,
    SidebarRightComponent,
    MessangerComponent,
    ChatPopupBoxComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    AngularFireModule.initializeApp(environment.firebase, 'worldwiders'),
    AngularFirestoreModule, // imports firebase/firestore, only needed for database features
    AngularFireAuthModule, // imports firebase/auth, only needed for auth features,
    AngularFireStorageModule // imports firebase/storage only needed for storage feature
  ],
  providers: [AuthService,AuthGuardService],
  bootstrap: [AppComponent]
})
export class AppModule { }
