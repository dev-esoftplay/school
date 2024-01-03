// withHooks
import { memo } from 'react';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Auth } from '../auth/login';




export interface MainIndexArgs {

}
export interface MainIndexProps {

}
function m(props: MainIndexProps): any {

  const [isSignedIn] = Auth.useSelector(data => [data.isLogin,{ persistKey: 'auth' }])
  const [loginAs]=Auth.useSelector(data=>[data.status,{persistKey:'auth'}])

  
    if (isSignedIn==true && loginAs=="teacher") {
      LibNavigation.navigate('teacher/index');
    }else if (isSignedIn==true && loginAs=="parent") {
      console.log("login as parent")
      LibNavigation.navigate('parent/index');
    } 
    else {
      LibNavigation.navigate('onboarding/onboarding');
    }
  // return (
  //   <View style={{ flex: 1, backgroundColor: 'white', alignContent: 'center',justifyContent:'center'}}>
  //     <Button title="Go to Login" onPress={() => {navigation.navigate('auth/login',console.log("click"))}} />
  //   </View>    
  // ) 
}
export default memo(m);