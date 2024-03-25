// withHooks
import { memo } from 'react';
import React, { useEffect, useRef, useState } from 'react';


// import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { MaterialIcons, FontAwesome5 } from '@expo/vector-icons';
// import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Image, Platform, View, Text, TouchableOpacity, Pressable } from 'react-native';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { TextInput } from 'react-native-gesture-handler';
import useSafeState from 'esoftplay/state';
import esp from 'esoftplay/esp';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import { LibImage } from 'esoftplay/cache/lib/image/import';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
// import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
// import navigation from 'esoftplay/modules/lib/navigation';
// import { Auth } from '../auth/login';


export interface ParentInfoArgs {

}
export interface ParentInfoProps {

}

// let slideup = useRef<LibSlidingup>(null)


function m(props: ParentInfoProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowEffect: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }

    const [Parent, setParent] = useState<any>([])

    let slideup = useRef<LibSlidingup>(null)
    let [image, setImage] = useSafeState<string | null>(null)
    let images: string = String(image) ?? 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
    const [username, setUsername] = useSafeState('');
    const [phone, setPhone] = useSafeState('');
    const [address, setAddress] = useSafeState('');

    function updateData() {
        LibProgress.show()
        const post = {
            name: username,
            image: image,
            phone: phone,
            address: address,
        }
        console.log('post', post)
        new LibCurl('parent_update', post, (result, msg) => {

            LibProgress.hide()
            // esp.log({ result, msg });

        }, (err) => {
            // esp.log({ err });
            LibProgress.hide()
            LibDialog.warning('Update Gagal', err?.message)
        })

        new LibCurl('parent', get, (result, msg) => {
            // esp.log({ result, msg });
            setParent(result)
            setImage(result.image)
            LibProgress.hide()
            LibDialog.info('Update Berhasil', 'Data Berhasil Diupdate')
        }, (err) => {
            // esp.log({ err });
            LibProgress.hide()
            LibDialog.warning('Update Gagal', err?.message)
        })
    }

    const hitApi = () => { }

    function loadParent() {
        new LibCurl('parent', get, (result, msg) => {
            console.log('ParentData', result)
            setParent(result)
        }, (err) => {
            console.log("error", err)
        }, 1)
    }

    useEffect(() => {
        loadParent();
    }, [])

    return (
        <View style={{ justifyContent: 'center', alignItems: 'center', height: LibStyle.height * 1 + 10, ...elevation(6) }}>

            <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', marginTop: 5 }}>
                <TouchableOpacity onPress={() => LibNavigation.back()} style={{ position: 'absolute', marginTop: -40, marginLeft: -185 }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color={'#000000'} />
                </TouchableOpacity>
            </View>

            <View style={{ justifyContent: 'center', marginTop: 10, marginBottom: 10 }}>
                <Image source={{ uri: Parent.image ?? 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }} style={{ width: 165, height: 165, borderRadius: 165 / 2, borderWidth: 3, borderColor: '#FAFAFA', ...elevation(5) }}></Image>
                {/* <Text style={{ color: '#000000', fontWeight: 'bold', fontSize: 25, textAlign: 'center', padding: 10 }}>Rocket Racoon, S.Ag, S.E, M.Pd, S.Pd</Text> */}
                <Pressable
                    onPress={() => slideup.current?.show()}
                    style={{ position: 'absolute', bottom: 0, right: 5, borderRadius: 45 / 2, backgroundColor: '#4B7AD6', width: 45, height: 45, justifyContent: 'center', alignItems: 'center', elevation: 3, shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                    <MaterialIcons name='edit' size={20} color='#FFFFFF' />
                </Pressable>
            </View>

            {/* <View style={{ justifyContent: 'center', flexDirection: 'row', marginTop: 10, marginHorizontal: 20, }}>
                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#4B7AD6', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Edit Profile?</Text>
                </TouchableOpacity>

                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#4B7AD6', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Edit Photo Profile?</Text>
                </TouchableOpacity>
            </View> */}

            {/* <View style={{ width: '90%', height: 60, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', alignContent: 'flex-start', justifyContent: 'space-between', alignItems: 'center', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, flexDirection: 'row' }}>
                <TextInput placeholder={ParentStudent.name ?? 'name'}
                    style={{ flex: 1, color: '#898989' }}
                    onChangeText={(text) => setUsername(text)}>
                    <MaterialIcons name='edit' size={20} color='#4B7AD6' style={{ alignContent: 'flex-end' }} />
                </TextInput>
            </View> */}

            <View style={{ justifyContent: 'flex-start' }}>

                <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, alignContent: 'flex-start', textAlign: 'left' }}>Nama</Text>
                
                <View style={{ width: LibStyle.width * 0.9, height: LibStyle.height * 0.1 - 21, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', justifyContent: 'space-between', alignItems: 'center', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, flexDirection: 'row' }}>
                    <TextInput placeholder={Parent.name ?? 'Nama'}
                        style={{ flex: 1, color: '#898989' }}
                        onChangeText={(text) => setUsername(text)}>
                    </TextInput>
                    <MaterialIcons name='edit' size={20} color='#4B7AD6' style={{ alignContent: 'flex-end' }} />
                </View>

                <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, alignContent: 'flex-start', textAlign: 'left' }}>Nomor Telp</Text>
                
                <View style={{ width: LibStyle.width * 0.9, height: LibStyle.height * 0.1 - 21, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', justifyContent: 'space-between', alignItems: 'center', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, flexDirection: 'row' }}>
                    <TextInput placeholder={'+' + Parent.phone ?? '+62'}
                        style={{ flex: 1, color: '#898989' }}
                        onChangeText={(text) => setPhone(text)}
                    />
                    <MaterialIcons name='edit' size={20} color='#4B7AD6' style={{ alignContent: 'flex-end' }} />
                </View>

                <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, alignContent: 'flex-start', textAlign: 'left' }}>Tanggal Lahir</Text>
                
                <View style={{ width: LibStyle.width * 0.9, height: LibStyle.height * 0.1 - 21, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', justifyContent: 'space-between', alignItems: 'center', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, flexDirection: 'row' }}>
                    <Text style={{ flex: 1, color: '#898989' }}>{Parent.birthday}</Text>
                    {/* <MaterialIcons name="edit" size={20} color="#4B7AD6" /> */}
                </View>

                <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 320, alignContent: 'center', textAlign: 'left' }}>Alamat</Text>
                
                <View style={{ width: LibStyle.width * 0.9, height: LibStyle.height * 0.1 - 21, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', justifyContent: 'space-between', alignItems: 'center', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, flexDirection: 'row' }}>
                    <TextInput placeholder={Parent.address}
                        style={{ flex: 1, color: '#898989' }}
                        onChangeText={(text) => setAddress(text)}
                    />
                    <MaterialIcons name='edit' size={20} color='#4B7AD6' style={{ alignContent: 'flex-end' }} />
                </View>

                <Pressable onPress={() => updateData()} style={{ padding: 13, alignItems: 'center', alignContent: 'center', backgroundColor: '#4B7AD6', borderRadius: 12, height: LibStyle.height * 0.1 - 30, width: LibStyle.width * 0.9, marginTop: 30 }}>
                    <Text style={{ justifyContent: 'center', fontSize: 17, fontWeight: 'bold', color: '#FFFFFF' }}>Simpan</Text>
                </Pressable>
            </View>



            <LibSlidingup ref={slideup} >
                <View style={{ backgroundColor: 'white', borderTopRightRadius: 20, borderTopLeftRadius: 20, paddingBottom: 5, paddingHorizontal: 19, }}>
                    <Text allowFontScaling={false} style={{ marginTop: 20, marginBottom: 20, fontFamily: "Arial", fontSize: 16, fontWeight: "bold", fontStyle: "normal", lineHeight: 22, letterSpacing: 0, textAlign: "center", color: "#34495e" }}></Text>
                    <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginBottom: 10 }}>

                        <Pressable
                            style={{ justifyContent: 'center', alignItems: 'center' }}
                            onPress={() =>
                                LibImage.fromCamera({ crop: { ratio: "1:1", forceCrop: true } }).then((url) => {
                                    slideup.current!.hide()
                                    setImage(String(url))
                                })} >
                            <View style={{ width: 60, height: 60, backgroundColor: '#ffffff', borderRadius: 50, justifyContent: 'center', alignItems: 'center', borderColor: '#4B7AD6', borderWidth: 2, marginBottom: 10 }}>
                                <LibIcon.FontAwesome name="camera" size={30} color="#4B7AD6" />
                            </View>
                            <Text style={{ color: '#000000', fontSize: 20, fontWeight: 'bold' }}>Kamera</Text>
                        </Pressable>

                        <Pressable
                            style={{ justifyContent: 'center', alignItems: 'center' }}
                            onPress={() =>
                                LibImage.fromGallery({ crop: { ratio: "1:1", forceCrop: true } }).then((url) => {
                                    // esp.log(url)
                                    console.log("url", url)
                                    slideup.current!.hide()
                                    setImage(String(url))
                                })
                            } >
                            <View style={{ width: 60, height: 60, backgroundColor: '#ffffff', borderRadius: 50, justifyContent: 'center', alignItems: 'center', borderColor: '#4B7AD6', borderWidth: 2, marginBottom: 10 }}>
                                <LibIcon.FontAwesome name="image" size={30} color="#4B7AD6" />
                            </View>
                            <Text style={{ color: '#000000', fontSize: 20, fontWeight: 'bold' }}>Galeri</Text>

                        </Pressable>
                    </View>
                </View>
            </LibSlidingup>

        </View>

    )
}
export default memo(m);