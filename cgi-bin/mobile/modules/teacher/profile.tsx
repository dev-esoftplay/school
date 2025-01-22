import { MaterialIcons } from "@expo/vector-icons";
import { LibCurl } from "esoftplay/cache/lib/curl/import";
import { LibDialog } from "esoftplay/cache/lib/dialog/import";
import { LibNavigation } from "esoftplay/cache/lib/navigation/import";
import { LibStyle } from "esoftplay/cache/lib/style/import";
import { UserClass } from "esoftplay/cache/user/class/import";
import esp from "esoftplay/esp";
import navigation from "esoftplay/modules/lib/navigation";
import React, { useEffect } from "react";
import { Platform, Pressable, Text, View } from "react-native";
import { Auth } from "../auth/login";
import { LibScroll } from "esoftplay/cache/lib/scroll/import";
import { LibPicture } from "esoftplay/cache/lib/picture/import";
import { hide } from "esoftplay/modules/lib/toast";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { LibNotification } from "esoftplay/cache/lib/notification/import";
import { useTimeout } from "esoftplay/timeout";

export interface TeacherProfileArgs {}
export interface TeacherProfileProps {}
export function pushToken(): void {
  console.log("Api pushToken ...");
  AsyncStorage.getItem("token").then((token: any) => {
    if (token) {
      let post = { token: token };
      new LibCurl(
        "user_token",
        post,
        (result, msg) => {
          console.log(token);
          console.log("result", result);
          console.log("msg", msg);
          UserClass?.pushToken();
        },
        (error) => {
          console.log("error", error);
          console.log(token);
          AsyncStorage.removeItem("push_id");
        }
      );
    }
  });
}

function m(props: TeacherProfileProps): any {
  const [resApi, setResApi] = React.useState<any>([]);
  const timeout = useTimeout();
  const data = UserClass.state().useSelector((s) => s);

  async function apilogout() {
    console.log("menjalankan apilogout....");
    esp.mod("lib/notification").requestPermission((token) => {
      console.log("token :..==", token);
      // const data = UserClass.state().useSelector(s => s)

      const post = { token: token };

      new LibCurl(
        "logout",
        null,
        (result, msg) => {
          console.log("check post", post);
          console.log("check apikey", data.apikey);
          console.log("check uri", data.uri);
          console.log("result", result);
          console.log("msg", msg);
        },
        (error) => {
          console.log("check post", post);
          console.log("check apikey", data.apikey);
          console.log("check uri", data.uri);
          console.log("api logout error :", error);
          console.log("apilogout");
        },
        1
      );
    });
  }

  function elevation(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return {
        shadowColor: "black",
        shadowOffset: { width: 0, height: value / 2 },
        shadowRadius: value,
        shadowOpacity: 0.24,
      };
    }
    return { elevation: value };
  }
  const logout = () => {
    console.log("menjalankan logout....");
    apilogout();
    timeout(() => {
      UserClass.pushToken();
      // pushToken()
      LibNotification.drop();
      Auth.reset();
      UserClass.delete();
      navigation.reset("onboarding/onboarding");
    }, 1000);
  };

  useEffect(() => {
    new LibCurl(
      "teacher",
      null,
      (result, msg) => {
        // esp.log({ result, msg });
        // console.log(esp.logColor.cyan, 'res: ' + JSON.stringify(result), esp.logColor.reset)

        console.log("result", result);
        setResApi(result);
      },
      (err) => {
        esp.log({ err });
        LibDialog.warning("get data gagal", err?.message);
      }
    );
  }, []);

  useEffect(() => {
    new LibCurl(
      "teacher",
      null,
      (result, msg) => {
        // esp.log({ result, msg });
        // console.log(esp.logColor.cyan, 'res: ' + JSON.stringify(result), esp.logColor.reset)

        console.log("result", result);
        setResApi(result);
      },
      (err) => {
        esp.log({ err });
        LibDialog.warning("get data gagal", err?.message);
      }
    );
  }, [resApi.image]);

  const Profilpic = () => {
    if (resApi.image) {
      return (
        <View
          style={{
            marginTop: 10,
            paddingHorizontal: 20,
            alignItems: "center",
            justifyContent: "center",
            alignContent: "center",
          }}
        >
          <LibPicture
            source={{ uri: resApi?.image }}
            style={{
              width: 100,
              height: 100,
              borderRadius: 100 / 2,
              borderWidth: 3,
              borderColor: "#FFFFFF",
            }}
          />

          <View style={{ height: "auto", padding: 5 }}>
            <Text
              style={{
                color: "#FFFFFF",
                fontWeight: "bold",
                fontSize: 18,
                textAlign: "center",
              }}
            >
              {resApi?.name ?? "name"}
            </Text>

            <View
              style={{
                flexDirection: "row",
                justifyContent: "center",
                alignItems: "center",
              }}
            >
              {resApi?.position.map((item: any, index: number) => (
                <View
                  key={index}
                  style={{
                    backgroundColor: "white",
                    width: "auto",
                    marginRight: 5,
                    borderRadius: 3,
                    ...elevation(3),
                    marginVertical: 5,
                    height: 30,
                    justifyContent: "center",
                    alignItems: "center",
                    paddingHorizontal: 10,
                  }}
                >
                  <Text style={{ fontSize: 10, fontWeight: "bold" }}>
                    {item}
                  </Text>
                </View>
              ))}
            </View>
          </View>
        </View>
      );
    } else {
      return (
        <View
          style={{
            width: 135,
            height: 135,
            borderRadius: 68,
            backgroundColor: "gray",
            justifyContent: "center",
            alignItems: "center",
            marginTop: 10,
            opacity: 0.8,
          }}
        />
      );
    }
  };
  return (
    <LibScroll style={{ flex: 1 }}>
      <View
        style={{
          height: LibStyle.height / 3.5,
          backgroundColor: "#136B93",
          justifyContent: "center",
          alignItems: "center",
          padding: 20,
          borderBottomLeftRadius: 40,
          borderBottomRightRadius: 40,
          ...elevation(6),
        }}
      >
        <Profilpic />
        {/* <View style={{ flexDirection: 'row', marginTop: 10, marginHorizontal: 20 }}>
                    <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#FFFFFF', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                        <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold' }}>{ParentStudent?.position ?? 'posisi'} </Text>
                    </TouchableOpacity>

                    <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#FFFFFF', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginLeft: 10 }}>
                        <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold' }}>Wali Kelas</Text>
                        <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold' }}>{resApi?.class_name ?? 'nama kelas'}</Text>
                    </TouchableOpacity>
                </View> */}
      </View>

      <View style={{ alignItems: "center", marginTop: 25 }}>
        <Pressable
          onPress={() => {
            LibNavigation.navigate("teacher/detail");
          }}
          style={{
            height: 55,
            width: LibStyle.width - 25,
            backgroundColor: "#136B93",
            justifyContent: "space-between",
            flexDirection: "row",
            alignItems: "center",
            borderRadius: 15,
            paddingHorizontal: 20,
          }}
        >
          <Text style={{ color: "#FFFFFF", fontWeight: "400", fontSize: 18 }}>
            Profil
          </Text>
          <MaterialIcons name="person" size={24} color="#FFFFFF" />
        </Pressable>
      </View>

      {resApi?.class_id && (
        <View style={{ alignItems: "center", marginTop: 15 }}>
          <Pressable
            onPress={() => {
              LibNavigation.navigate("teacher/myclass", {
                clasid: resApi?.class_id,
              });
            }}
            style={{
              height: 55,
              width: LibStyle.width - 25,
              backgroundColor: "#136B93",
              justifyContent: "space-between",
              flexDirection: "row",
              alignItems: "center",
              borderRadius: 15,
              paddingHorizontal: 20,
            }}
          >
            <Text style={{ color: "#FFFFFF", fontWeight: "400", fontSize: 18 }}>
              Kelasku
            </Text>
            <MaterialIcons name="class" size={24} color="#FFFFFF" />
          </Pressable>
        </View>
      )}

      {/* <View style={{ alignItems: 'center', marginTop: 15 }}>
                <Pressable onPress={() => { LibNavigation.navigate('teacher/notifications') }} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'space-between', flexDirection: 'row', alignItems: 'center', borderRadius: 15, paddingHorizontal: 20 }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, }}>Notifikasi</Text>
                    <MaterialIcons name='notifications' size={24} color='#FFFFFF' />
                </Pressable> */}
      {/* </View> */}

      {/* <View style={{ alignItems: 'center', marginTop: 15 }}>
                <Pressable onPress={() => { LibNavigation.navigate('teacher/password') }} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'space-between', flexDirection: 'row', alignItems: 'center', borderRadius: 15, paddingHorizontal: 20 }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, }}>Ganti Kata Sandi</Text>
                    <MaterialIcons name='lock' size={24} color='#FFFFFF' />
                </Pressable>
            </View> */}

      <View style={{ alignItems: "center", marginTop: 15 }}>
        <Pressable
          onPress={() =>
            LibDialog.confirm(
              "Peringatan",
              "Apakah Anda Ingin Keluar?",
              "ya",
              () => {
                logout();
              },
              "tidak",
              () => hide()
            )
          }
          style={{
            height: 55,
            width: LibStyle.width - 25,
            backgroundColor: "#136B93",
            justifyContent: "space-between",
            flexDirection: "row",
            alignItems: "center",
            borderRadius: 15,
            paddingHorizontal: 20,
          }}
        >
          <Text style={{ color: "#FFFFFF", fontWeight: "400", fontSize: 18 }}>
            Keluar
          </Text>
          <MaterialIcons name="logout" size={24} color="#FFFFFF" />
        </Pressable>
      </View>
      {/* TEST !!! */}
      {/* <View style={{ alignItems: 'center', marginTop: 15 }}>
                <Pressable onPress={() => LibNavigation.navigate('utils/test')} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'space-between', flexDirection: 'row', alignItems: 'center', borderRadius: 15, paddingHorizontal: 20 }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, }}>test </Text>
                    <MaterialIcons name='warning' size={24} color='#FFFFFF' />
                </Pressable>
            </View> */}
    </LibScroll>
  );
}
export default m;
