// withHooks

import { LibCrypt } from 'esoftplay/cache/lib/crypt/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
import useSafeState from 'esoftplay/state';
import React from 'react';
import { Button, Text, View } from 'react-native';


export interface UserLoginArgs {

}
export interface UserLoginProps {

}




export default function m(props: UserLoginProps): any {
    const [resApi, setResApi] = useSafeState<any>();



    // useEffect(() => {
    //     login()
    // }, [])


    function login(username?: any, password?: any) {
        // // console.log("eeee")
        const post = {
            // username: "33333",
            // password: "yasin,
            username: new LibCrypt().encode(username ?? ''),
            password: new LibCrypt().encode(password ?? ''),
        }
        // // console.log(post)
        LibProgress.show('Loading')
        new LibCurl('public_login', post, (result, msg) => {
            LibProgress.hide(),
                //isi resApi dengan result
                setResApi(result)
            //isi response dengan result
           
            // // console.log("id",result.id);
            // // console.log("name",result.name)

          

        }, (err) => {
            LibProgress.hide()

            // console.log("FAILED", err)
        })
    }
    esp.log(resApi, "lll")
    // // console.log("response",response?.teacher?.name)

    return (
        <View style={{ flex: 1, backgroundColor: "orange", paddingTop: 40 }}>
            <Button title="test" onPress={() => login()} />
            <Text>{resApi?.name}</Text>

        </View>
    )
}