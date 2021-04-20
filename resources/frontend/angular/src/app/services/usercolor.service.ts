import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

const baseUrl = 'http://localhost/api';

@Injectable({
  providedIn: 'root'
})
export class UsercolorService {
  constructor(private http: HttpClient) { }

  getAllUsers(): Observable<any> {
    return this.http.get(baseUrl+'/users');
  }

  getAllColors(): Observable<any> {
    return this.http.get(baseUrl+'/colors');
  }

  updateColorSelection(usercolor_id, data): Observable<any> {
    return this.http.put(baseUrl+'/colors/'+usercolor_id, data);
  }

  addColorToUser(data): Observable<any> {
    return this.http.post(baseUrl+'/colors', data);
  }

  getUserColor(user_id): Observable<any> {
    return this.http.get(baseUrl+'/user/'+user_id);
  }

  deleteUserColor(usercolor_id): Observable<any> {
    return this.http.delete(baseUrl+'/colors/'+usercolor_id);
  }
}
