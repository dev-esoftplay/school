// withHooks
import { memo } from 'react';
import { useEffect } from 'react';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Auth } from '../auth/login';
import { UserClass } from 'esoftplay/cache/user/class/import';
import { Text, View } from 'react-native';




export interface MainIndexArgs {

}
export interface MainIndexProps {

}
function m(props: MainIndexProps): any {
  const role: string = UserClass.state().get().group_ids[0];
  console.log("role", role)

  useEffect(() => {
    if (role) {
      if (role == "3") {
        LibNavigation.replace('parent/index')
      } else if (role == "5") {
        LibNavigation.replace('teacher/index')
      }
    }
    else {
      LibNavigation.replace('auth/login')
    }
  }, [])

}
export default memo(m);